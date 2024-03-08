from flask import Flask, jsonify
import paramiko
app = Flask(__name__)
@app.route('/images')
def get_images():
    try:
        # Configuration de la connexion SSH
        ssh = paramiko.SSHClient()
        ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
        ssh.connect('ip_address', port=78448484888, username='xxxx', password='xxxx')
        # Exécution de la commande Docker pour obtenir les détails des images
        stdin, stdout, stderr = ssh.exec_command('docker images --format "{{.Repository}}"')
        # Récupération des noms d'images
        image_names = stdout.readlines()
        ssh.close()
        # Renvoyer les noms d'images disponibles en format JSON
        return jsonify({'image_count': len(image_names), 'image_names': image_names})
    except Exception as e:
        return jsonify({'error': str(e)}), 500
if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)