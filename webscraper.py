from flask import Flask, render_template
import requests
from bs4 import BeautifulSoup

app = Flask(__name__)

def scrape_leaderboard_data():
    # Perform web scraping here to retrieve player statistics
    url = 'https://lol.fandom.com/wiki/LPL/2023_Season/Summer_Season/Player_Statistics'
    response = requests.get(url)

    if response.status_code == 200:
        soup = BeautifulSoup(response.content, 'html.parser')

        # Find and extract the table containing player statistics
        target_table = soup.find('table', {'class': 'wikitable'})
        if target_table:
            rows = target_table.find_all('tr')[4:]  # Skip the header rows

            leaderboard_data = []
            for row in rows:
                player_stats = [cell.get_text(strip=True) for cell in row.find_all(['th', 'td'])]
                leaderboard_data.append({
                    'player_name': player_stats[0],
                    'team': player_stats[1],
                    'games_played': player_stats[2],
                    'wins': player_stats[3],
                    'losses': player_stats[4],
                    'win_rate': player_stats[5],
                    'kills': player_stats[6],
                    'deaths': player_stats[7],
                    'assists': player_stats[8],
                    'kda': player_stats[9],
                    'cs': player_stats[10],
                    'cs_per_min': player_stats[11],
                    'gold': player_stats[12],
                    'gold_per_min': player_stats[13],
                    'damage': player_stats[14],
                    'damage_per_min': player_stats[15],
                    'kill_participation': player_stats[16],
                    'kill_share': player_stats[17],
                    'gold_share': player_stats[18],
                    # Add other statistics as needed
                })

            return leaderboard_data
        else:
            return None
    else:
        return None

@app.route('/landing.php')
def show_leaderboard():
    leaderboard_data = scrape_leaderboard_data()
    if leaderboard_data:
        return render_template('leaderboard.html', leaderboard_data=leaderboard_data)
    else:
        return "Failed to retrieve leaderboard data"

if __name__ == '__main__':
    app.run(debug=True)
