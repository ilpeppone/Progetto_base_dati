import pandas as pd

df_artisti = pd.read_csv("/home/peppe/Progetto_base_dati/pandas/artist_data.csv")#creaiamo il dataframe df_artisti importando il csv artisti

#conversione delle colonne nell'ordine corretto, nel tipo di dato appropriato, riem
df_artisti['id'] = pd.to_numeric(df_artisti['id'], downcast='integer')
df_artisti['name'] = df_artisti['name'].astype(str).fillna('Unknown')
df_artisti['gender'] = df_artisti['gender'].astype(str).fillna('Unknown')
df_artisti['dates'] = df_artisti['dates'].astype(str).fillna('Unknown')
df_artisti['yearOfBirth'] = pd.to_numeric(df_artisti['yearOfBirth'], errors='coerce').fillna(9999).astype(int)
df_artisti['yearOfDeath'] = pd.to_numeric(df_artisti['yearOfDeath'], errors='coerce').fillna(9999).astype(int)
df_artisti['placeOfBirth'] = df_artisti['placeOfBirth'].astype(str).fillna('Unknown')
df_artisti['placeOfDeath'] = df_artisti['placeOfDeath'].astype(str).fillna('Unknown')
df_artisti['url'] = df_artisti['url'].astype(str).fillna('Unknown')

print(df_artisti.dtypes)#verifichiamo se interpretati i dati nel dataframe come ci aspettiamo
print(df_artisti.shape)#verifichiamo quante tuple e attributi ci sono

# rimuoviamo eventuali ridondaze fra tuple
df_artisti = df_artisti.drop_duplicates()

print(df_artisti.shape)#verifichiamo quante tuple e attributi ci sono dopo aver eliminato duplicati

df_artisti.to_csv('/home/peppe/Progetto_base_dati/artisti_puliti.csv', index=False)
#########

df_lavori = pd.read_csv("/home/peppe/Progetto_base_dati/pandas/artwork_data.csv")

df_lavori['id'] = pd.to_numeric(df_lavori['id'], downcast='integer')
df_lavori['accession_number'] = df_lavori['accession_number'].astype(str)
df_lavori['artist'] = df_lavori['artist'].astype(str)
df_lavori['artistRole'] = df_lavori['artistRole'].astype(str)
df_lavori['artistId'] = pd.to_numeric(df_lavori['artistId'], downcast='integer')
df_lavori['title'] = df_lavori['title'].astype(str)
df_lavori['dateText'] = df_lavori['dateText'].astype(str)
df_lavori['medium'] = df_lavori['medium'].astype(str)
df_lavori['creditLine'] = df_lavori['creditLine'].astype(str)
df_lavori['year'] = pd.to_numeric(df_lavori['year'], errors='coerce').fillna(9999).astype(pd.Int64Dtype())
df_lavori['acquisitionYear'] = pd.to_numeric(df_lavori['acquisitionYear'].fillna(9999), downcast='integer')
df_lavori['dimensions'] = df_lavori['dimensions'].astype(str)
df_lavori['width'] = pd.to_numeric(df_lavori['width'], errors='coerce')
df_lavori['height'] = pd.to_numeric(df_lavori['height'], errors='coerce')
df_lavori['depth'] = pd.to_numeric(df_lavori['depth'], errors='coerce')
df_lavori['units'] = df_lavori['units'].astype(str)
df_lavori['inscription'] = df_lavori['inscription'].astype(str)
df_lavori['thumbnailCopyright'] = df_lavori['thumbnailCopyright'].astype(str)
df_lavori['thumbnailUrl'] = df_lavori['thumbnailUrl'].astype(str)
df_lavori['url'] = df_lavori['url'].astype(str)

print(df_lavori.dtypes)
print(df_lavori.shape)
df_lavori.to_csv('/home/peppe/Progetto_base_dati/lavori_puliti.csv', index=False)

