import requests
from bs4 import BeautifulSoup
import sys
import json

def scrape_player_data(url):
    response = requests.get(url)

    if response.status_code == 200:
        soup = BeautifulSoup(response.text, 'html.parser')
        target_table = soup.find('table', {'class': 'wikitable'})

        if target_table:
            rows_to_skip = 5
            rows = target_table.find_all('tr')[rows_to_skip:]

            player_data_list = []
            for row in rows:
                player_data = [cell.get_text(strip=True) for cell in row.find_all(['td', 'th'])]
                player_data_list.append(player_data)

            return json.dumps(player_data_list)
        else:
            return "Table not found on the page."
    else:
        return f"Failed to retrieve the page. Status code: {response.status_code}"

if __name__ == "__main__":
    if len(sys.argv) > 1:
        url = sys.argv[1]
        scraped_data = scrape_player_data(url)
        print(scraped_data)
    else:
        print("Please provide a URL as an argument.")
