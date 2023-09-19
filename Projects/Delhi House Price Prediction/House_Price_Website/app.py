from flask import Flask, render_template, url_for, flash, redirect
import joblib
from flask import request
import numpy as np

app = Flask(__name__)

@app.route('/')

@app.route("/House")
def home():
    return render_template("index.html")

def ValuePredictor(to_predict_list, size):
    to_predict = np.array(to_predict_list).reshape(1,size)
    if(size==10):
        loaded_model = joblib.load(r'C:\Users\guptanuj890\OneDrive\Desktop\pro\Projects\Delhi House Price Prediction\House_Price_Website\rfr.pkl')
        result = loaded_model.predict(to_predict)
    return result[0]

@app.route('/predict', methods = ["POST"])
def predict():
    if request.method == "POST":
        to_predict_list = request.form.to_dict()
        to_predict_list = list(to_predict_list.values())
        to_predict_list = list(map(float, to_predict_list))
        
        if(len(to_predict_list)==10):
            result = ValuePredictor(to_predict_list,10)
    
    return(render_template("result.html", prediction_text=result))       

if __name__ == '__main__':

    app.run(debug=True)