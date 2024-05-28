from flask import Flask, render_template, url_for, flash, redirect
import joblib
from flask import request
import numpy as np

app = Flask(__name__)

# Load the encoding information
#encoding_info = joblib.load('encoding_info.joblib')

# Load the trained machine learning model
# Replace 'your_trained_model.joblib' with the actual filename of your trained model
#model = joblib.load(r'C:\xampp\htdocs\MedicalRecordsDirectory-master\flask\HeartDisease\models\abchp.joblib')

loaded_model = joblib.load(r'C:\xampp\htdocs\MedicalRecordsDirectory-master\flask\HeartDisease\models\abchp.joblib')

@app.route('/')
@app.route("/House")
def home():
    return render_template("index.html")

@app.route('/predict', methods=["POST"])
def predict():
    if request.method == "POST":
        Age = int(request.form['Age'])
        Gender = request.form['Gender']
        if Gender=='Female':
            Sex_F = 1
            Sex_M = 0
        else:
            Sex_M = 1
            Sex_F = 0    
        chestpain = request.form['chestpain']
        if chestpain=='ASY':
            ChestPainType_ASY=1
            ChestPainType_ATA=0
            ChestPainType_NAP=0
            ChestPainType_TA=0
        elif chestpain=='ATA':
            ChestPainType_ASY=0
            ChestPainType_ATA=1
            ChestPainType_NAP=0
            ChestPainType_TA=0
        elif chestpain=='NAP':
            ChestPainType_ASY=0
            ChestPainType_ATA=0
            ChestPainType_NAP=1
            ChestPainType_TA=0
        elif chestpain=='TA':
            ChestPainType_ASY=0
            ChestPainType_ATA=0
            ChestPainType_NAP=0
            ChestPainType_TA=1          

        RestingBP = int(request.form['RestingBP'])
        cholesterol = int(request.form['cholesterol'])
        FastingBS = int(request.form['FastingBS'])
        RestingECG = request.form['RestingECG']
        if RestingECG=='LVH':
            RestingECG_LVH=1
            RestingECG_Normal=0
            RestingECG_ST=0
        elif RestingECG=='Normal':
            RestingECG_LVH=0
            RestingECG_Normal=1
            RestingECG_ST=0
        elif RestingECG=='ST':
            RestingECG_LVH=0
            RestingECG_Normal=0
            RestingECG_ST=1

        MaxHR = int(request.form['MaxHR'])
        OldPeak = int(request.form['OldPeak'])
        ExerciseAngina = request.form['MaxHR']
        if ExerciseAngina == 'yes':
            ExerciseAngina_Y = 1
            ExerciseAngina_N = 0
        else:
            ExerciseAngina_Y = 0
            ExerciseAngina_N = 1    
        ST_Slope = request.form['ST_Slope']
        if ST_Slope=='Down':
            ST_Slope_Down=1
            ST_Slope_Flat=0
            ST_Slope_Up=0
        elif ST_Slope=='Flat':
            ST_Slope_Down=0
            ST_Slope_Flat=1
            ST_Slope_Up=0
        elif ST_Slope=='Up':
            ST_Slope_Down=0
            ST_Slope_Flat=0
            ST_Slope_Up=1

        

        # Create a list of features in the correct order and format
        input_data = [Age,RestingBP,cholesterol,FastingBS,MaxHR,OldPeak,Sex_F,Sex_M,ChestPainType_ASY,ChestPainType_ATA,ChestPainType_NAP,ChestPainType_TA,RestingECG_LVH,RestingECG_Normal,RestingECG_ST,ExerciseAngina_N,ExerciseAngina_Y,ST_Slope_Down,ST_Slope_Flat,ST_Slope_Up]

        # Predict using the model
        prediction_result = loaded_model.predict([input_data])
        result = prediction_result[0]

    return render_template("index.html", prediction_text=result)
if __name__ == '__main__':

    app.run(debug=True)