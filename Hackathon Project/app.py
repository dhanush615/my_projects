from flask import Flask, request, jsonify, render_template
from googletrans import Translator, LANGUAGES

app = Flask(__name__)

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/clg')
def clg():
    return render_template('clg.html')

@app.route('/translate')
def translate():
    text = request.args.get('text', '')
    try:
        translator = Translator()
        translation = translator.translate(text, dest='hi')
        return jsonify({'translation': translation.text})
    except Exception as e:
        return jsonify({'error': str(e)})

if __name__ == '__main__':
    app.run(debug=True)