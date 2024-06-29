import pandas as pd

# Creazione del dataframe df_artisti importando il CSV artisti
df_artisti = pd.read_csv("/home/peppe/Progetto_base_dati/pandas/artist_data.csv")

# Conversione delle colonne nell'ordine corretto, nel tipo di dato appropriato, e riempimento dei valori mancanti
df_artisti['id'] = pd.to_numeric(df_artisti['id'], downcast='integer')
df_artisti['name'] = df_artisti['name'].fillna('Missing').astype(str)
df_artisti['gender'] = df_artisti['gender'].fillna('Missing').astype(str)
df_artisti['dates'] = df_artisti['dates'].fillna('Missing').astype(str)
df_artisti['yearOfBirth'] = pd.to_numeric(df_artisti['yearOfBirth'], errors='coerce').fillna(9999).astype(int)
df_artisti['yearOfDeath'] = pd.to_numeric(df_artisti['yearOfDeath'], errors='coerce').fillna(9999).astype(int)
df_artisti['placeOfBirth'] = df_artisti['placeOfBirth'].fillna('Missing').astype(str)
df_artisti['placeOfDeath'] = df_artisti['placeOfDeath'].fillna('Missing').astype(str)
df_artisti['url'] = df_artisti['url'].fillna('Missing').astype(str)

print(df_artisti.dtypes)#verifichiamo se interpretati i dati nel dataframe come ci aspettiamo
print(df_artisti.shape)#verifichiamo quante tuple e attributi ci sono

# rimuoviamo eventuali ridondaze fra tuple
df_artisti = df_artisti.drop_duplicates()

print(df_artisti.shape)#verifichiamo quante tuple e attributi ci sono dopo aver eliminato duplicati

df_artisti.to_csv('/home/peppe/Progetto_base_dati/artisti_puliti.csv', index=False)
#########

# Creazione del dataframe df_lavori importando il CSV artwork_data
df_lavori = pd.read_csv("/home/peppe/Progetto_base_dati/pandas/artwork_data.csv")

# Conversione delle colonne nel tipo di dato appropriato e riempimento dei valori mancanti
df_lavori['id'] = pd.to_numeric(df_lavori['id'], downcast='integer')
df_lavori['accession_number'] = df_lavori['accession_number'].fillna('Missing').astype(str)
df_lavori['artist'] = df_lavori['artist'].fillna('Missing').astype(str)
df_lavori['artistRole'] = df_lavori['artistRole'].fillna('Missing').astype(str)
df_lavori['artistId'] = pd.to_numeric(df_lavori['artistId'], downcast='integer', errors='coerce').astype(int)
df_lavori['title'] = df_lavori['title'].fillna('Missing').astype(str)
df_lavori['dateText'] = df_lavori['dateText'].fillna('Missing').astype(str)
df_lavori['medium'] = df_lavori['medium'].fillna('Missing').astype(str)
df_lavori['creditLine'] = df_lavori['creditLine'].fillna('Missing').astype(str)
df_lavori['year'] = pd.to_numeric(df_lavori['year'], errors='coerce').fillna(9999).astype(pd.Int64Dtype())
df_lavori['acquisitionYear'] = pd.to_numeric(df_lavori['acquisitionYear'], errors='coerce').fillna(9999).astype(pd.Int64Dtype())
df_lavori['dimensions'] = df_lavori['dimensions'].fillna('Missing').astype(str)
df_lavori['width'] = pd.to_numeric(df_lavori['width'], errors='coerce').fillna(0).astype(float)
df_lavori['height'] = pd.to_numeric(df_lavori['height'], errors='coerce').fillna(0).astype(float)
df_lavori['depth'] = pd.to_numeric(df_lavori['depth'], errors='coerce').fillna(0).astype(float)
df_lavori['units'] = df_lavori['units'].fillna('Missing').astype(str)
df_lavori['inscription'] = df_lavori['inscription'].fillna('Missing').astype(str)
df_lavori['thumbnailCopyright'] = df_lavori['thumbnailCopyright'].fillna('Missing').astype(str)
df_lavori['thumbnailUrl'] = df_lavori['thumbnailUrl'].fillna('Missing').astype(str)
df_lavori['url'] = df_lavori['url'].fillna('Missing').astype(str)

df_artisti=df_lavori.drop_duplicates()

print(df_lavori.dtypes)
print(df_lavori.shape)
df_lavori.to_csv('/home/peppe/Progetto_base_dati/lavori_puliti.csv', index=False)

