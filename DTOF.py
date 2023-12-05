from flask import Flask, render_template
from flask_sqlalchemy import SQLAlchemy

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'your_database_uri_here'  # Replace with your actual database URI
db = SQLAlchemy(app)

# Define a model for your player stats table
class PlayerStats(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    league_name = db.Column(db.String(100))
    games_played = db.Column(db.Integer)
    wins = db.Column(db.Integer)
    losses = db.Column(db.Integer)
    win_rate = db.Column(db.Float)
    kills = db.Column(db.Float)
    deaths = db.Column(db.Float)
    assists = db.Column(db.Float)
    kda = db.Column(db.Float)
    cs = db.Column(db.Float)
    cs_per_min = db.Column(db.Float)
    gold = db.Column(db.Float)
    gold_per_min = db.Column(db.Float)
    damage = db.Column(db.Float)
    damage_per_min = db.Column(db.Float)
    kpar = db.Column(db.Float)
    ks = db.Column(db.Float)
    gs = db.Column(db.Float)
    cp = db.Column(db.Float)
    champions = db.Column(db.Integer)
    # Define other columns for each statistic field

# Route to fetch stats from the database
@app.route('/')
def landing_page():
    stats_from_db = PlayerStats.query.all()  # Retrieve stats from the database
    return render_template('landing_page.html', player_stats=stats_from_db)
@app.route('/search', methods=['GET'])
def search_player():
    player_name = request.args.get('player_name', '')
    
    if player_name:
        # Query the database for the player stats using the provided name
        stats_from_db = PlayerStats.query.filter_by(league_name=player_name).all()
    else:
        # If no name provided, display all player stats
        stats_from_db = PlayerStats.query.all()

    return render_template('landing.html', player_stats=stats_from_db)

if __name__ == '__main__':
    app.run(debug=True)

if __name__ == '__main__':
    app.run(debug=True)
