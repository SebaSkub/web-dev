from flask import Flask, render_template, request
import requests
from bs4 import BeautifulSoup

app = Flask(__name__)

def scrape_player_data(url):
    response = requests.get(url)
    if response.status_code == 200:
        soup = BeautifulSoup(response.text, 'html.parser')
        target_table = soup.find('table', {'class': 'wikitable'})
        if target_table:
            rows = target_table.find_all('tr')[5:]  # Skip headers
            player_data_list = []
            for row in rows:
                player_stats = row.find_all(['td', 'th'])
                if len(player_stats) >= 18:  # Ensure there are enough stats to extract
                    player = {
                        'name': player_stats[0].get_text(strip=True),
                        'team': player_stats[1].get_text(strip=True),
                        'games_played': player_stats[2].get_text(strip=True),
                        'wins': player_stats[3].get_text(strip=True),
                        'losses': player_stats[4].get_text(strip=True),
                        'win_rate': player_stats[5].get_text(strip=True),
                        'kills': player_stats[6].get_text(strip=True),
                        'deaths': player_stats[7].get_text(strip=True),
                        'assists': player_stats[8].get_text(strip=True),
                        'kda': player_stats[9].get_text(strip=True),
                        'cs': player_stats[10].get_text(strip=True),
                        'cs_per_min': player_stats[11].get_text(strip=True),
                        'gold': player_stats[12].get_text(strip=True),
                        'gold_per_min': player_stats[13].get_text(strip=True),
                        'damage': player_stats[14].get_text(strip=True),
                        'damage_per_min': player_stats[15].get_text(strip=True),
                        'kill_participation': player_stats[16].get_text(strip=True),
                        'kill_share': player_stats[17].get_text(strip=True),
                        'gold_share': player_stats[18].get_text(strip=True),
                        # Add other fields as required
                    }
                    player_data_list.append(player)
            return player_data_list
        else:
            return None
 
