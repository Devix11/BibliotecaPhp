<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet"> -->
        <link rel="stylesheet" href="./homepage.css">
        <title>Benvenuto</title>
    </head>   
    <body>
        <b>
            <h1>Benvenuto nella biblioteca Online</h1>
        </b>
        <h3>Esplora la nostra collezione di libri o gestisci il tuo account</h3> <br>
        <button onclick="location.href='login.php'">Accedi</button> &nbsp;&nbsp;&nbsp;
        <button onclick="location.href='signup.php'">Registrati</button>
    </body>
</html>



----------------------------------------------------------------------------------------------------

1. Cookie e variabili di sessione. Illustra questi due strumenti messi a disposizione dai linguaggi lato server. Che relazione intercorre tra i due?

I cookie e le variabili di sessione sono entrambi strumenti utilizzati nei linguaggi di programmazione lato server per gestire lo stato delle sessioni degli utenti durante l'interazione con un'applicazione web. Tuttavia, hanno approcci leggermente diversi e vengono utilizzati per scopi diversi, anche se talvolta possono essere usati insieme.

Ecco una spiegazione di entrambi:

1. Cookie:
   - I cookie sono piccoli pezzi di dati memorizzati sul lato client (di solito nel browser dell'utente) e inviati al server con ogni richiesta HTTP. 
   - Vengono utilizzati principalmente per conservare informazioni specifiche dell'utente, come preferenze, identificativi di sessione, dati di accesso, ecc.
   - I cookie possono essere permanenti (persistenti) o temporanei (di sessione). I cookie persistenti rimangono sul dispositivo dell'utente anche dopo la chiusura del browser, mentre i cookie di sessione vengono eliminati quando il browser viene chiuso.
   - I cookie sono spesso utilizzati per tracciare l'attività dell'utente sul sito web e personalizzare l'esperienza dell'utente.

2. Variabili di sessione:
   - Le variabili di sessione sono variabili memorizzate sul lato server che mantengono lo stato della sessione dell'utente durante la sua interazione con l'applicazione web.
   - Ogni utente che accede al sito web ottiene una sessione unica, e le variabili di sessione vengono utilizzate per memorizzare informazioni specifiche dell'utente durante la durata di quella sessione.
   - Le variabili di sessione sono spesso utilizzate per memorizzare dati sensibili o informazioni di autenticazione, poiché sono conservate sul lato server e non sono accessibili direttamente dal client.
   - Le variabili di sessione sono generalmente più sicure rispetto ai cookie, poiché i dati sensibili non vengono trasferiti tra client e server, ma sono mantenuti solo sul server.

Relazione:
- I cookie possono essere utilizzati per implementare il meccanismo di gestione delle sessioni. Ad esempio, un identificatore di sessione può essere memorizzato in un cookie e utilizzato per recuperare le informazioni della sessione sul lato server.
- Le variabili di sessione possono essere utilizzate per memorizzare informazioni più sensibili o complesse relative alla sessione dell'utente, mentre i cookie sono più adatti per informazioni leggere o non sensibili.
- In alcuni casi, i cookie possono essere utilizzati per mantenere lo stato della sessione (ad esempio, salvando l'identificatore di sessione), mentre le variabili di sessione vengono utilizzate per memorizzare dati aggiuntivi relativi alla sessione.

----------------------------------------------------------------------------------------------------

2. Descrivere le pratiche viste a lezione per quanto riguarda la realizzazione di una login. Quali sono le caratteristiche che deve avere un processo di login in (funzionalità e sicurezza)? Quali strumenti messi a disposizione di un linguaggio lato server e quali pratiche aiutano a raggiungere tali scopi?

Per realizzare un processo di login sicuro e funzionale, è necessario considerare diverse pratiche e caratteristiche. Ecco alcune delle pratiche comuni viste in lezione per la realizzazione di una login:

1. **Autenticazione robusta**: Il processo di login deve garantire che solo gli utenti autorizzati possano accedere all'applicazione. Questo viene solitamente realizzato attraverso la verifica delle credenziali dell'utente, come nome utente e password.

2. **Gestione delle credenziali**: Le credenziali degli utenti devono essere gestite in modo sicuro. Le password devono essere crittografate prima di essere memorizzate nel database per evitare che siano compromesse in caso di violazione della sicurezza.

3. **Controllo degli accessi**: Dopo il login, l'utente dovrebbe avere accesso solo alle risorse e alle funzionalità dell'applicazione a cui è autorizzato. È importante implementare adeguati controlli degli accessi per garantire che le informazioni sensibili siano protette e che gli utenti non possano accedere a risorse non autorizzate.

4. **Gestione delle sessioni**: Una volta autenticato, l'utente dovrebbe mantenere la sua autenticazione per un certo periodo di tempo o finché non si disconnette volontariamente. Le sessioni possono essere gestite utilizzando cookie, variabili di sessione o altri meccanismi per mantenere lo stato dell'utente tra le richieste HTTP.

5. **Protezione contro attacchi**: È importante proteggere il processo di login da vari tipi di attacchi, come attacchi di forza bruta, attacchi di injection (ad esempio, SQL injection) e attacchi di phishing. Ciò può essere ottenuto attraverso la validazione dei dati di input, l'implementazione di meccanismi di difesa come i CAPTCHA e l'uso di HTTPS per crittografare le comunicazioni tra client e server.

6. **Registrazione delle attività di accesso**: È consigliabile registrare tutte le attività di accesso, inclusi tentativi falliti e riusciti, per monitorare eventuali attività sospette e per scopi di audit.

Per quanto riguarda gli strumenti messi a disposizione dai linguaggi lato server e le pratiche per raggiungere questi obiettivi:

- Linguaggi come PHP, Python (con framework come Django o Flask), Java (con framework come Spring), Node.js (con framework come Express) forniscono librerie e strumenti per gestire l'autenticazione degli utenti, la gestione delle sessioni e la protezione delle applicazioni web.
- Framework e librerie spesso forniscono funzionalità di autenticazione e autorizzazione integrate, semplificando il processo di implementazione di un sistema di login sicuro.
- È importante utilizzare funzionalità come la crittografia per memorizzare le password in modo sicuro, gestire correttamente le sessioni utente, implementare controlli di accesso appropriati e utilizzare librerie di sicurezza per proteggere le applicazioni da attacchi comuni.

Implementare queste pratiche aiuta a garantire che il processo di login sia sia funzionale che sicuro, proteggendo le informazioni sensibili degli utenti e prevenendo accessi non autorizzati.

----------------------------------------------------------------------------------------------------

3. SQL injection è una vulnerabilità comune delle applicazioni web che consente a un attaccante di inserire istruzioni SQL dannose all'interno di campi di input per eseguire operazioni non autorizzate sul database. Questo tipo di attacco sfrutta la mancanza di validazione o di filtraggio dei dati inseriti dall'utente prima di essere utilizzati nelle query SQL.

Ecco un esempio semplice di SQL injection:

Supponiamo di avere un modulo di login in cui l'utente inserisce il proprio nome utente e la password, e il codice PHP per verificare le credenziali è il seguente:

    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";

Se un utente maleintenzionato inserisce nella casella di input della password il seguente testo:

    ' OR '1'='1

La query risultante diventerà:

    SELECT * FROM users WHERE username='' OR '1'='1' AND password=''

Poiché '1'='1' è sempre vero, la condizione WHERE sarà soddisfatta per tutte le righe nel database, permettendo all'attaccante di accedere all'applicazione senza conoscere le credenziali corrette.
Sì, l'operatore OR può essere utilizzato a scopo di intrusione in una SQL injection, come mostrato nell'esempio sopra.
Per diminuire la vulnerabilità a questo tipo di attacchi, è importante adottare le seguenti pratiche:

- Validazione dei dati di input: Verificare e validare tutti i dati inseriti dagli utenti, assicurandosi che siano del tipo atteso e non contengano caratteri speciali non autorizzati.
- Parametrizzazione delle query: Utilizzare sempre statement SQL parametrizzati o prepared statements per eseguire le query, in modo che i dati dell'utente vengano separati dalle istruzioni SQL e non possano essere interpretati come parte dell'istruzione.
- Limitare i privilegi del database: Utilizzare account di database con privilegi minimi necessari per eseguire le operazioni richieste dall'applicazione, in modo da limitare il potenziale impatto di un'eventuale SQL injection.
- Aggiornare e proteggere il software: Assicurarsi che il software utilizzato per sviluppare l'applicazione web sia aggiornato e che siano applicate le ultime patch di sicurezza per mitigare le vulnerabilità note.

Per quanto riguarda PHP, per prevenire le SQL injection, è possibile utilizzare le funzionalità messe a disposizione dalle estensioni PDO (PHP Data Objects) o MySQLi (MySQL Improved). Entrambe queste estensioni supportano prepared statements, che separano i dati dall'istruzione SQL. Ecco un esempio di come utilizzare prepared statements con PDO in PHP:

    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    // Fetch risultati...

BONUS

Le "Union attacks" sono un tipo di SQL injection avanzata in cui un attaccante sfrutta l'operatore UNION per unire il risultato di una query malevola con il risultato di una query legittima. Questo può consentire all'attaccante di estrarre dati sensibili o eseguire altre azioni dannose. Ad esempio:

    SELECT username, password FROM users WHERE username = '' UNION SELECT 'attacker', 'maliciouspassword'

Questa query potrebbe essere utilizzata per aggiungere un account dell'attaccante con password specificata nell'istruzione UNION. Per mitigare questo tipo di attacco, è necessario utilizzare prepared statements e validare rigorosamente i dati di input dell'utente.

----------------------------------------------------------------------------------------------------

4. Descrivi, con opportuni esempi, il processo di realizzazione di ognuna delle CRUD (una per ciascun tipo) presenti nella tua applicazione. Per ciascuna fattispecie identifica possibili problematicità (e, se conosciuta, loro gestione) relativi all’utilizzo da parte dell’utente di un’applicazione che interagisce con un database.

Le operazioni CRUD (Create, Read, Update, Delete) sono fondamentali per la gestione dei dati in un'applicazione. Qui di seguito descriverò il processo di realizzazione di ognuna di esse, evidenziando possibili problematiche e le relative soluzioni.

1. Create (Creazione):
   - Scopo: Consente di creare nuovi record nel database.
   - Processo di realizzazione:
     1. L'utente compila un modulo con i dati necessari per il nuovo record.
     2. I dati vengono inviati al server attraverso una richiesta HTTP, di solito di tipo POST.
     3. Sul lato server, i dati vengono validati e sanitizzati per prevenire SQL injection e altri attacchi.
     4. I dati validati vengono quindi utilizzati per eseguire una query SQL per inserire il nuovo record nel database.

   - Possibili problematiche:
     - SQL injection: È fondamentale utilizzare prepared statements o query parametrizzate per evitare l'inserimento di dati dannosi nel database.
     - Validazione dei dati: Assicurarsi che tutti i dati inseriti dall'utente siano validati e che siano rispettate le restrizioni del database (es. chiavi uniche, vincoli di tipo).

2. Read (Lettura):
   - Scopo: Consente di recuperare dati dal database per visualizzarli all'utente.
   - Processo di realizzazione:
     1. L'utente richiede una visualizzazione dei dati attraverso un'interfaccia utente (es. pagina web).
     2. Il server riceve la richiesta e esegue una query SQL per recuperare i dati richiesti dal database.
     3. I dati vengono quindi inviati al client (browser dell'utente) per la visualizzazione.

   - Possibili problematiche:
     - Prestazioni: Se la tabella contiene un gran numero di record, potrebbero verificarsi rallentamenti nelle operazioni di lettura. È possibile ottimizzare le query, utilizzare la memorizzazione nella cache o implementare la paginazione per gestire grandi set di dati.

3. Update (Aggiornamento):
   - Scopo: Consente di modificare i dati esistenti nel database.
   - Processo di realizzazione:
     1. L'utente seleziona il record che desidera modificare e compila un modulo con i nuovi dati.
     2. I dati vengono inviati al server attraverso una richiesta HTTP, di solito di tipo POST o PUT.
     3. Sul lato server, i dati vengono validati e sanitizzati.
     4. I dati validati vengono utilizzati per eseguire una query SQL per aggiornare il record nel database.

   - Possibili problematiche:
     - Concorrenza: Se più utenti tentano di modificare lo stesso record contemporaneamente, potrebbero verificarsi conflitti. È possibile implementare un sistema di blocco ottimistico o pessimistico per gestire questa situazione.

4. Delete (Eliminazione):
   - Scopo: Consente di eliminare record dal database.
   - Processo di realizzazione:
     1. L'utente seleziona il record che desidera eliminare attraverso un'interfaccia utente.
     2. L'utente conferma l'eliminazione.
     3. Il server riceve la richiesta di eliminazione e esegue una query SQL per eliminare il record dal database.

   - Possibili problematiche:
     - Riferimenti incrociati: Se il record da eliminare è referenziato da altri record in altre tabelle, potrebbe verificarsi un'integrità referenziale. È possibile gestire questa situazione definendo vincoli di chiave esterna con azioni di eliminazione in cascata o implementando un controllo delle dipendenze prima dell'eliminazione.

Gestire queste problematiche è essenziale per garantire la sicurezza e l'affidabilità dell'applicazione, nonché per offrire un'esperienza utente fluida e priva di errori.

----------------------------------------------------------------------------------------------------

Ecco alcuni esempi di query di collegamento tra PHP e un database MySQL utilizzando PDO (PHP Data Objects) e MySQLi:

Utilizzo di PDO:

    // Connessione al database
    $pdo = new PDO('mysql:host=localhost;dbname=mydatabase', 'username', 'password');

    // Esempio di query di selezione utilizzando prepared statement
    $stmt = $pdo->prepare('SELECT * FROM mytable WHERE id = :id');
    $stmt->execute(['id' => 1]);
    $row = $stmt->fetch();

    echo $row['column_name'];

    // Esempio di inserimento di dati utilizzando prepared statement
    $stmt = $pdo->prepare('INSERT INTO mytable (column1, column2) VALUES (:value1, :value2)');
    $stmt->execute(['value1' => 'data1', 'value2' => 'data2']);

Utilizzo di MySQLi:

    // Connessione al database
    $mysqli = new mysqli('localhost', 'username', 'password', 'mydatabase');

    // Esempio di query di selezione
    $result = $mysqli->query('SELECT * FROM mytable WHERE id = 1');
    $row = $result->fetch_assoc();

    echo $row['column_name'];

    // Esempio di inserimento di dati
    $mysqli->query("INSERT INTO mytable (column1, column2) VALUES ('data1', 'data2')");

Questi sono solo esempi di base di come eseguire operazioni di base come selezione e inserimento di dati nel database utilizzando PDO e MySQLi in PHP. È importante notare che è necessario gestire gli errori e le eccezioni appropriatamente, e che sarebbe opportuno utilizzare prepared statements per prevenire SQL injection come descritto in precedenza.

----------------------------------------------------------------------------------------------------

Ecco un esempio di come creare una connessione a un database MySQL utilizzando PDO in PHP:

    <?php
        // Parametri di connessione al database
        $host = 'localhost'; // Indirizzo del server del database
        $dbname = 'nome_database'; // Nome del database
        $username = 'utente'; // Nome utente del database
        $password = 'password'; // Password del database

        try {
            // Creazione della connessione PDO
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

            // Impostazione dell'attributo per segnalare errori di SQL
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            echo "Connessione al database riuscita!";
        } catch(PDOException $e) {
            // Gestione degli errori di connessione
            echo "Errore di connessione al database: " . $e->getMessage();
        }
    ?>

In questo esempio, la connessione al database viene stabilita utilizzando il costruttore di PDO, fornendo l'indirizzo del server del database, il nome del database, il nome utente e la password come parametri. Successivamente, viene impostato l'attributo `PDO::ATTR_ERRMODE` su `PDO::ERRMODE_EXCEPTION`, che abilita la modalità di gestione delle eccezioni, in modo che PDO lanci un'eccezione ogni volta che si verifica un errore durante l'esecuzione di una query. Infine, viene gestita l'eccezione `PDOException` nel caso in cui si verifichi un errore durante la connessione al database.

///