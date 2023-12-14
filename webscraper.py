import requests
from bs4 import BeautifulSoup

def scrape_player_data(url):
    # Send an HTTP GET request to the website
    response = requests.get(url)

    # Check if the request was successful
    if response.status_code == 200:
        soup = BeautifulSoup(response.text, 'html.parser')

        # Find the specific table you want to scrape
        target_table = soup.find('table', {'class': 'wikitable'})

        # Check if the table is found
        if target_table:
            # Extract and accumulate the data for each player into a single string
            rows_to_skip = 5
            rows = target_table.find_all('tr')[rows_to_skip:]

            player_data_list = []
            for row in rows:
                # Extract and accumulate the data for each player into a single string
                player_data = ' '.join(cell.get_text(strip=True) for cell in row.find_all(['td', 'th']))
                player_data_list.append(player_data)

            # Join all player data into a single string separated by newlines
            result = '\n'.join(player_data_list)
            print(result)

        else:
            print("Table not found on the page.")

    else:
        print(f"Failed to retrieve the page. Status code: {response.status_code}")

# Example usage:
url = 'https://lol.fandom.com/wiki/LPL/2023_Season/Summer_Season/Player_Statistics'
scrape_player_data(url)
