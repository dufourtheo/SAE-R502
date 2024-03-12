<?php

class MainController extends AbstractController 
{
#[Route('/create-challenge', name: 'admin_challenge_create')]
    public function createChallenge(Request $request): Response
    {
        // Connexion SSH
        $ssh = new SSH2('127.0.0.1', 2222);
        if (!$ssh->login('user', 'password')) {
            $this->addFlash('error', 'Échec de connexion SSH');
            return $this->redirectToRoute('admin_index');
        }

        // Exécuter la commande cURL pour obtenir les noms des images Docker
        $curlCommand = 'curl -s -X GET http://127.0.0.1:5000/images';
        $imagesCommandOutput = $ssh->exec($curlCommand);

        // Vérifier et traiter la réponse JSON
        $imagesData = json_decode($imagesCommandOutput, true);
        if ($imagesData === null || !isset($imagesData['image_names'])) {
            $this->addFlash('error', 'Failed to retrieve image names');
            return $this->redirectToRoute('admin_index');
        }

        $imageNames = $imagesData['image_names'];

        // Créer le formulaire avec les noms des images disponibles
        $challenge = new Challenge();
        $challenge->setCreatedAt(new \DateTime());
        $form = $this->createForm(AddChallengeTypeFormType::class, $challenge, [
            'image_choices' => array_combine($imageNames, $imageNames),
        ]);

        // Gérer la soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Gérer le téléchargement du fichier ici
            $uploadedFile = $form->get('uploadedFile')->getData();
            if ($uploadedFile) {
                $newFilename = uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
                try {
                    $uploadedFile->move(
                        $this->getParameter('app.upload_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // Gérer les erreurs de téléchargement ici
                }

                $challenge->setUploadedFile($newFilename);
            }

            // Récupérer et définir la difficulté
            $difficulty = $form->get('difficulty')->getData();
            $challenge->setDifficulty($difficulty);

            // Récupérer et définir l'image sélectionnée
            $selectedImage = $form->get('selectedImage')->getData();
            $challenge->setSelectedImage($selectedImage);

            // Enregistrer le challenge en base de données
            $entityManager = $this->entityManager;
            $entityManager->persist($challenge);
            $entityManager->flush();

            $this->addFlash('success', 'Challenge créé avec succès !');
            return $this->redirectToRoute('admin_index');
        }

        $this->addFlash('error', 'Une erreur s\'est produite lors de la récupération des images Docker');
        return $this->render('admin/add_challenge.html.twig', [
            'form' => $form ? $form->createView() : null,
            'image_choices' => $imageNames,
        ]);
    }
}