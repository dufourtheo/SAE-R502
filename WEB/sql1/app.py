import os
from flask import Flask, render_template, request

# Création de l'application Flask
app = Flask(__name__)

# Définition de la route pour la page d'accueil
@app.route('/')
def home():
    return render_template('index.html')

# Définition de la route pour la fonction de recherche
@app.route('/search')
def search():
    # Récupération du paramètre 'name' de l'URL
    name = request.args.get('name')

    # FLAG
    if name == "' OR '1'='1":
        return "HACKCESS{Sql_3saY}"
    elif name == "' OR '1'='1' --'":
        return "HACKCESS{Sql_3saY}"
    elif name == " OR 1=1":
        return "HACKCESS{Sql_3saY}"
    #--------------------------------#
    elif name.lower() == 'hello':
        return "Bonjour ! Comment ça va ?"
    elif name.lower() == 'open sesame':
        return "Tu as trouvé la bonne formule !"
    elif name.lower() == 'whoami':
        return "root@hackcess.sql"
    elif name.lower() == 'ls':
        directory_contents = ['file1.txt', 'file2.txt', 'file3.txt', 'flag.txt']
        return "<br>".join(directory_contents)
    elif name.lower() == 'cat flag.txt':
        return "HACKCESS-Essaye_Injec_SQL"
    elif name.lower() == "cat file1.txt" or name.lower() == "cat file2.txt" or name.lower() == "cat file3.txt":
        return "Je ne suis pas le flag, va voir flag.txt"

    # Retourner un message par défaut si aucune correspondance n'est trouvée
    return "Pas de résultat trouvé pour {}".format(name)

# Point d'entrée pour exécuter l'application Flask
if __name__ == '__main__':
    app.run(debug=False, host='0.0.0.0')