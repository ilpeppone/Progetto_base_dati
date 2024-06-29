# Progetto_base_dati
A.A. 2023/2024

Il progetto del corso di basi di dati 2023/2024 consiste nella realizzazione di un sito web che permetta di visualizzare gli artisti e le relative opere presenti nel database dei musei Tate (Tate Modern, Tate Britain, Tate Liverpool e Tate St. Ives).

I dati relativi ad artisti ed opere da importare nel database sono contenuti in un archivio (project_data_museo.zip) che può essere scaricato dal Classroom. La fonte dei dati è un repository su GitHub (https://github.com/tategallery/collection).

Basandosi sulla struttura dei dati a disposizione le tabelle saranno verosimilmente due: artista e opera. La difficoltà dal punto di vista del database sarà quella di identificare eventuali chiavi esterne e attributi duplicati e gestirli di conseguenza. Prestate attenzione a come gestite i dati, alcuni record potrebbero avere dei campi non valorizzati o non sempre formattati come vi aspettate. Utilizzate Python e Pandas per effettuare la pulizia dei dati.

Il sito web deve essere composto da una serie di pagine, ognuna delle quali deve offrire una funzionalità e deve offrire le seguenti funzionalità di minima:
1 Ricerca di un artista inserendo uno o più parametri (anche parziali) - nel caso in cui
nessun parametro venga specificato deve essere presentata la lista completa degli
artisti;
2 Visualizzazione di tutte le opere di un determinato artista, eventualmente suddivise per tipologia e presentando un report generale sotto forma di tabella, su anni, tipologie, etc...;
3 Ricerca delle opere inserendo uno o più parametri (anche parziali), in forma libera o eventualmente guidata;
4 calcolo di statistiche relative ad artisti e opere, ad esempio:
4.1 numero di opere realizzate in un determinato anno;
4.2 numero di artisti nati e/o morti in una determinata nazione;
4.3 numero di opere per artista;

Non obbligatorio (ma concorre al voto finale) è l’ampliamento del punto 4 con qualche (da 1 a 3) interrogazioni di vostra invenzione. 

Il progetto può essere svolto in gruppi di al massimo 2 persone e non deve essere consegnato, ma dovrà essere mostrato in una delle date di “Presentazione progetto e Verbalizzazione” durante la quale io vi chiederò di mostrarmi il progetto e di dimostrarmi il corretto funzionamento del vostro progetto. Prenderò l’occasione per porvi qualche domanda sul codice che avete scritto. 

Almeno un paio di giorni prima della consegna dovete inviarmi una piccola relazione di un paio di pagine in cui illustrate che operazioni avete fatto durante la fase di pulizia dei dati e le query SQL che avete scritto per i punti 1,2,3,4 e la descrizione di come avete inserito i dati all’interno del Database. La mail deve contenere inoltre la bcomposizione del gruppo.

