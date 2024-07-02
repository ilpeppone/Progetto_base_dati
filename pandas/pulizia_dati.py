import pandas as pd
#importiamo il CSV 
df_artisti = pd.read_csv("/home/peppe/Progetto_base_dati/pandas/artist_data.csv")

#conversione delle colonne nell'ordine corretto, riempimento dei valori mancanti e nel tipo di dato appropriato 
df_artisti['id'] = pd.to_numeric(df_artisti['id'], errors='coerce').astype(pd.Int32Dtype())
df_artisti['name'] = df_artisti['name'].replace('', pd.NA).astype(pd.StringDtype())
df_artisti['gender'] = df_artisti['gender'].replace('', pd.NA).astype(pd.StringDtype())
df_artisti = df_artisti.drop(columns=['dates'])  # Rimozione della colonna 'dates' perché derivata
df_artisti['yearOfBirth'] = pd.to_numeric(df_artisti['yearOfBirth'], errors='coerce').astype(pd.Int32Dtype())
df_artisti['yearOfDeath'] = pd.to_numeric(df_artisti['yearOfDeath'], errors='coerce').astype(pd.Int32Dtype())
df_artisti['placeOfBirth'] = df_artisti['placeOfBirth'].replace('', pd.NA).astype(pd.StringDtype())
df_artisti['placeOfDeath'] = df_artisti['placeOfDeath'].replace('', pd.NA).astype(pd.StringDtype())
df_artisti['url'] = df_artisti['url'].astype(pd.StringDtype())

print(df_artisti.dtypes)#verifichiamo se interpretati i dati nel dataframe come ci aspettiamo
print(df_artisti.shape)#verifichiamo quante tuple e attributi ci sono

df_artisti = df_artisti.drop_duplicates()# rimuoviamo eventuali ridondaze fra tuple

print(df_artisti.shape)#verifichiamo quante tuple e attributi ci sono dopo aver eliminato duplicati
max_lengths = df_artisti.apply(lambda col: col.astype(str).str.len().max())
print(max_lengths)#verifico la dimensione massima di ogni colonna degli artisti per stringa
df_artisti.to_csv('/home/peppe/Progetto_base_dati/artisti_puliti.csv', index=False)#esportiamo senza indicizzare
#########
# creiamo il dataframe df_lavori importando il CSV artwork_data
df_lavori = pd.read_csv("/home/peppe/Progetto_base_dati/pandas/artwork_data.csv")

#conversione delle colonne nell'ordine corretto, riempimento dei valori mancanti e nel tipo di dato appropriato 
df_lavori['id'] = pd.to_numeric(df_lavori['id'],  errors='coerce').astype(pd.Int32Dtype())
df_lavori['accession_number'] = df_lavori['accession_number'].replace('', pd.NA).astype(pd.StringDtype())
df_lavori= df_lavori.drop(columns=['artist'])#artist lo tolgo perchè il nome è già presente nel csv degli artisti
df_lavori['artistRole'] = df_lavori['artistRole'].replace('', pd.NA).astype(pd.StringDtype())
df_lavori['artistId'] = df_lavori['artistId'].replace('', pd.NA).astype(pd.StringDtype())
df_lavori['title'] = df_lavori['title'].replace('', pd.NA).astype(pd.StringDtype())
df_lavori['dateText'] = df_lavori['dateText'].replace('', pd.NA).astype(pd.StringDtype())#lo lascio perchè ci sono informazioni aggiuntive
df_lavori['medium'] = df_lavori['medium'].replace('', pd.NA).astype(pd.StringDtype())
df_lavori['creditLine'] = df_lavori['creditLine'].replace('', pd.NA).astype(pd.StringDtype())
df_lavori['year'] = pd.to_numeric(df_lavori['year'], errors='coerce').astype(pd.Int32Dtype())
df_lavori['acquisitionYear'] = pd.to_numeric(df_lavori['acquisitionYear'], errors='coerce').astype(pd.Int32Dtype())
df_lavori['dimensions'] = df_lavori['dimensions'].replace('', pd.NA).astype(pd.StringDtype())
df_lavori = df_lavori.drop(columns=['width', 'height', 'depth','units'])#width,height,depth sono derivati da dimensions
#units lo tolgo perchè già presente nel csv degli artisti
df_lavori['inscription'] = df_lavori['inscription'].replace('', pd.NA).astype(pd.StringDtype())
df_lavori['thumbnailCopyright'] = df_lavori['thumbnailCopyright'].replace('', pd.NA).astype(pd.StringDtype())
df_lavori['thumbnailUrl'] = df_lavori['thumbnailUrl'].replace('', pd.NA).astype(pd.StringDtype())
df_lavori['url'] = df_lavori['url'].replace('', pd.NA).astype(pd.StringDtype())

print(df_lavori.dtypes)#visualizziamo se i dati sono stati convertiti nel tipo che abbiamo indicato


df_realizza = pd.DataFrame({
    'artistId': df_lavori['artistId'],  # colonna degli id degli artisti dalle opere
    'artworkId': df_lavori['id'],       # colonna degli id delle opere
    'accession_number': df_lavori['accession_number'],  # colonna degli accession number delle opere
    'artistRole': df_lavori['artistRole']  # colonna dei ruoli degli artisti nelle opere
})

df_lavori = df_lavori.drop(columns=['artistId', 'artistRole'])
df_realizza= df_realizza.drop_duplicates()
max_lengths = df_realizza.apply(lambda col: col.astype(str).str.len().max())
#verifico la dimensione massima di ogni colonna delle opere per stringa
print(max_lengths)
df_realizza.to_csv('/home/peppe/Progetto_base_dati/realizza.csv', index=False)




print(df_lavori.shape)#verifichiamo quanti valori ci sono
df_lavori=df_lavori.drop_duplicates() #eliminazione di eventuali righe duplicate
print(df_lavori.shape)#verifichiamo quanti valori ci sono dopo aver eliminato i duplicati
# Calcola la lunghezza massima dei valori in ciascuna colonna
max_lengths = df_lavori.apply(lambda col: col.astype(str).str.len().max())
#verifico la dimensione massima di ogni colonna delle opere per stringa
print(max_lengths)
df_lavori.to_csv('/home/peppe/Progetto_base_dati/lavori_puliti.csv', index=False)#esportiamo senza indicizzare

