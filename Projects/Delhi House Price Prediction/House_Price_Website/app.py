from flask import Flask, render_template, url_for, flash, redirect
import joblib
from flask import request
import numpy as np

app = Flask(__name__)

@app.route('/')

@app.route("/House")
def cancer():
    return render_template("index.html")

if __name__ == '__main__':

    app.run(debug=True)