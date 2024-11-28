from flask import Flask, render_template, url_for, request
import joblib
import re
import string
import pandas as pd

app = Flask(__name__)
app = Flask(__name__, static_url_path='/assets')
Model = joblib.load('model.pkl')


@app.route('/')
def index():
    return render_template("predict.html")

def wordpre(text):
    text = text.lower()   # convert to lower text
    text = re.sub(r'\[.*?\\]', '', text) #remove text within square bracket
    text = re.sub("\\W", " ", text)  # remove special chars
    text = re.sub(r'https?://\S+|www\.\S+', '', text) # Remove URLs starting with http or https and www
    text = re.sub('<.*?>+', '', text) #remove the text within angular bracket
    text = re.sub('[%s]' % re.escape(string.punctuation), '', text) # Remove punctuation marks
    text = re.sub('\n', '', text) # Remove newline characters
    text = re.sub(r'\w*\d\w*', '', text) # Remove words containing digits
    return text


@app.route('/', methods=['POST'])
def pre():
    if request.method == 'POST':
        txt = request.form['txt']
        txt = wordpre(txt)
        txt = pd.Series(txt)
        result = Model.predict(txt)
        return render_template("predict.html", result=result)
    return ''


if __name__ == "__main__":
    app.run(debug=True)
