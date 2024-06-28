import pandas as pd

df_artisti = pd.read_csv("/home/peppe/Progetto_base_dati/pandas/artist_data.csv")#creaiamo il dataframe df_artisti importando il csv artisti

# Converti le colonne nell'ordine corretto
df_artisti['id'] = df_artisti['id'].astype('Int64')
df_artisti['name'] = df_artisti['name'].astype(str)
df_artisti['gender'] = df_artisti['gender'].astype(str)
df_artisti['dates'] = df_artisti['dates'].astype(str)
df_artisti['yearOfBirth'] = df_artisti['yearOfBirth'].fillna(pd.NA).astype(pd.Int64Dtype())
df_artisti['yearOfDeath'] = df_artisti['yearOfDeath'].fillna(pd.NA).astype(pd.Int64Dtype())
df_artisti['placeOfBirth'] = df_artisti['placeOfBirth'].astype(str)
df_artisti['placeOfDeath'] = df_artisti['placeOfDeath'].astype(str)
df_artisti['url'] = df_artisti['url'].astype(str)

print(df_artisti.dtypes)#verifichiamo come vengono interpretati i dati nel dataframe
print(df_artisti.shape)#verifichiamo quante tuple e attributi ci sono
df_artisti.to_csv('/home/peppe/Progetto_base_dati/artisti.csv', index=False)
#########

df_lavori = pd.read_csv("/home/peppe/Progetto_base_dati/pandas/artwork_data.csv")
print(df_lavori.dtypes)
df_lavori ['id']=df_lavori['id'].astype('Int64')
df_lavori['accession_number']=df_lavori['accession_number'].astype(str)
df_lavori['artist']=df_lavori['artist'].astype(str)
df_lavori['artistRole']=df_lavori['artistRole'].astype(str)
df_lavori['artistId']=df_lavori['artistId'].astype('Int64')
df_lavori['title']=df_lavori['title'].astype(str)
df_lavori['dateText']=df_lavori['dateText'].astype(str)
df_lavori['medium']=df_lavori['medium'].astype(str)
df_lavori['creditLine']=df_lavori['creditLine'].astype(str)
###
df_lavori['year'] = pd.to_numeric(df_lavori['year'], errors='coerce').fillna(pd.NA).astype(pd.Int64Dtype())
####
df_lavori['acquisitionYear'] = df_lavori['acquisitionYear'].fillna(pd.NA).astype(pd.Int64Dtype())

df_lavori['dimensions']=df_lavori['dimensions'].astype(str)
df_lavori['width'] = pd.to_numeric(df_lavori['width'], errors='coerce') #non c'è bisogno di convertire in float perchè pd.to_numeric converte direttamente in float
###
df_lavori['height']=pd.to_numeric(df_lavori['height'], errors='coerce')
df_lavori['depth']=pd.to_numeric(df_lavori['depth'], errors='coerce')
df_lavori['units']=df_lavori['units'].astype(str)
df_lavori['inscription']=df_lavori['inscription'].astype(str)
df_lavori['thumbnailCopyright']=df_lavori['thumbnailCopyright'].astype(str)
df_lavori['thumbnailUrl']=df_lavori['thumbnailUrl'].astype(str)
df_lavori['url']=df_lavori['url'].astype(str)
df_lavori.to_csv('/home/peppe/Progetto_base_dati/lavori.csv', index=False)