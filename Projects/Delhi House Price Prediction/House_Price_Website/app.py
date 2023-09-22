from flask import Flask, render_template, url_for, flash, redirect
import joblib
from flask import request
import numpy as np

app = Flask(__name__)

@app.route('/')

@app.route("/House")
def home():
    return render_template("index.html")

# # def ValuePredictor(to_predict_list, size):
# #     to_predict = np.array(to_predict_list).reshape(1,size)
# #     if(size==10):
# #         loaded_model = joblib.load(r'C:\Users\guptanuj890\OneDrive\Desktop\pro\Projects\Delhi House Price Prediction\House_Price_Website\rfr.pkl')
# #         result = loaded_model.predict(to_predict_list)
# #     return result[0]

# @app.route('/predict', methods = ["POST"])
# def predict():
#     if request.method == "POST":
#         Area=int(request.form['Area'])
#         BHK=int(request.form['BHK'])
#         Bathroom=int(request.form['Bathroom'])
#         Furnishing=request.form['Furnishing']
#         if Furnishing=='Semi-Furnished':
#             Furnishing=1
#         elif Furnishing=='Furnished':

#             Furnishing=0
#         else:
#             Furnishing=2

#         Locality=request.form['Locality']
#         if Locality=='Rohini Sector':
#             Locality=9
#         elif Locality=='Dwarka Sector':
#             Locality=0
#         elif Locality=='Shahdara':
#             Locality=10 
#         elif Locality=='Vasant Kunj':
#             Locality=11 
#         elif Locality=='Paschim Vihar':
#             Locality=7
#         elif Locality=='Vasundhara Enclave':
#             Locality=12
#         elif Locality=='Punjabi Bagh':
#             Locality=8
#         elif Locality=='Kalkaji':
#             Locality=2 
#         elif Locality=='Lajpat Nagar':
#             Locality=3
#         elif Locality=='Laxmi Nagar':                 
#             Locality=4
#         elif Locality=='New Friends Colony':
#             Locality=5
#         elif Locality=='Kailash Colony':
#             Locality=1
#         else:
#             Locality=6
#         Parking=int(request.form['Parking'])
#         Status=request.form['Status']
#         if Status=='Ready_to_move':
#             Status=1
#         else:
#             Status=0  
#         Transaction=request.form['Transaction']
#         if Transaction=='New_Property':
#             Transaction=0
#         else:
#             Transaction=1
#         Type=request.form['Type']
#         if Type=='Builder_Floor':
#             Type=1
#         else:
#             Type=0
#         Per_Sqft=float(request.form['PerSqft'])                                             
#         loaded_model = joblib.load(r'C:\Users\guptanuj890\OneDrive\Desktop\pro\Projects\Delhi House Price Prediction\House_Price_Website\models\rfr.pkl')      
#         prediction_result=loaded_model.predict([['Area','BHK','Bathroom','Furnishing','Locality','Parking','Status','Transaction','Type','Per_Sqft']])
#         result=prediction_result[0]
#     return(render_template("result.html", prediction_text=result))       





@app.route('/predict', methods=["POST"])
def predict():
    if request.method == "POST":
        Area = float(request.form['Area'])
        BHK = int(request.form['BHK'])
        Bathroom = int(request.form['Bathroom'])
        Furnishing = request.form['Furnishing']
        Furnishing = 1 if Furnishing == 'Semi-Furnished' else 0
        Locality=request.form['Locality']
        if Locality=='Rohini Sector':
            Locality=9
        elif Locality=='Dwarka Sector':
            Locality=0
        elif Locality=='Shahdara':
            Locality=10 
        elif Locality=='Vasant Kunj':
            Locality=11 
        elif Locality=='Paschim Vihar':
            Locality=7
        elif Locality=='Vasundhara Enclave':
            Locality=12
        elif Locality=='Punjabi Bagh':
            Locality=8
        elif Locality=='Kalkaji':
            Locality=2 
        elif Locality=='Lajpat Nagar':
            Locality=3
        elif Locality=='Laxmi Nagar':                 
            Locality=4
        elif Locality=='New Friends Colony':
            Locality=5
        elif Locality=='Kailash Colony':
            Locality=1
        else:
            Locality=6

        Parking = int(request.form['Parking'])
        Status = request.form['Status']
        Status = 1 if Status == 'Ready_to_move' else 0

        Transaction = request.form['Transaction']
        Transaction = 0 if Transaction == 'New_Property' else 1

        Type = request.form['Type']
        Type = 1 if Type == 'Builder_Floor' else 0

        Per_Sqft = float(request.form['Per_Sqft'])

        loaded_model = joblib.load(r'C:\Users\guptanuj890\OneDrive\Desktop\pro\Projects\Delhi House Price Prediction\House_Price_Website\models\rfr.pkl')

        # Create a list of features in the correct order and format
        input_data = [Area, BHK, Bathroom, Furnishing, Locality, Parking, Status, Transaction, Type, Per_Sqft]

        # Predict using the model
        prediction_result = loaded_model.predict([input_data])
        result = prediction_result[0]

    return render_template("result.html", prediction_text=result)
if __name__ == '__main__':

    app.run(debug=True)