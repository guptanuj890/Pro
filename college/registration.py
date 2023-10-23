from flask import Flask, render_template, request, redirect, url_for
from flask_sqlalchemy import SQLAlchemy

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'mssql+pyodbc://root:@server/database?driver=ODBC+Driver+17+for+SQL+Server'
db = SQLAlchemy(app)

class User(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(80))
    dob = db.Column(db.Date)
    gender = db.Column(db.String(10))
    state = db.Column(db.String(80))
    phone = db.Column(db.String(15))
    email = db.Column(db.String(120), unique=True)
    password = db.Column(db.String(120))

db.create_all()

@app.route('/register', methods=['GET', 'POST'])
def register():
    if request.method == 'POST':
        name = request.form['name']
        dob = request.form['dob']
        gender = request.form['gender']
        state = request.form['state']
        phone = request.form['phone']
        email = request.form['email']
        password = request.form['password']

        user = User(name=name, dob=dob, gender=gender, state=state, phone=phone, email=email, password=password)
        db.session.add(user)
        db.session.commit()
        return redirect(url_for('success'))
    return render_template('register.html')

@app.route('/success')
def success():
    return 'Registration successful!'

if __name__ == '__main__':
    app.run(debug=True)
