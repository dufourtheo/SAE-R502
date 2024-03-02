import os
from flask import Flask, render_template, request
app = Flask(__name__, template_folder=os.path.join(os.getcwd(), 'templates'))
@app.route('/')
def home():
    return render_template('index.html')
@app.route('/search')
def search():
    name = request.args.get('name')
    if name == "' OR '1'='1":
        return "HACKCESS{Sql_3saY}" 
    return "No results found for {}".format(name)
if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0')