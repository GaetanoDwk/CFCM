# CFCM
<img src=/images/logo.png height='200px' alt='logo'>
Computer Forensics Case Manager<br>

<p>CFCM è un gestionale open-source web based pensato per piccole aziende o singoli professionisti nel settore della Digital Forensics. Permette di gestire agevolmente le informazioni relative agli artefatti informatici ed infine generare una reportistica in pdf.
Inoltre integra dei "tools" di ausilio al lavoro con altri strumenti che un tecnico forense utilizza spesso; come ad esempio Ftk Toolkit e Cellebrite Ufed Reader.</p>
<h2>Pre-Requisiti</h2>
<p>L'installazione del gestionale richiede la presenza dell'ambiente di sviluppo per PHP denominato <a href="https://www.apachefriends.org/download.html" rel="nofollow">Xampp (3.2.4 o superiore)</a><br>
  Quest'ultimo integra già al suo interno tutto l'occorrente, ovvero:</p>
  <ul>
    <li>Web Server Apache 2.4.46</li>
    <li>Interprete PHP 8</li>
    <li>Database MySQL 8 / MariaDb 10.4</li>
  </ul>
<p>Inoltre, nonostante Xampp integri già <a href="https://www.phpmyadmin.net/" rel="nofollow">PhpMyAdmin</a> che permette di gestire MySQL da pannello web, è utile installare un software per la gestione del database come i seguenti:</p>
<ul>
  <li><a href="https://www.mysql.com/products/workbench/" rel="nofollow">MySQL Workbench</a>
  <li><a href="https://www.heidisql.com/" rel="nofollow">HeidiSQL</a></li>
  <li><a href="https://navicat.com/en/products/navicat-for-mysql" rel="nofollow">Navicat for MySQL</a> (consigliato)</li>
  <li><a href="https://dbeaver.io/" rel="nofollow">DBeaver</a> (consigliato)</li>
</ul>

<h2>Installazione</h2>
Per procedere all'installazione è necessario seguire i seguenti punti:
<ol>
<li>
<p>Scaricare il progetto.</p>
</li>

<li>
  <p>Creare una cartella denominata <code>cfcm</code> nella directory <code>C:\xampp\htdocs\</code> ed estrarre all'interno di tale path il contenuto della release scaricata. Il percorso della directory in cui inserire CFCM varia in base all'ambiente software in utilizzo:</p>
  <ul>
    <li><a href="https://www.apachefriends.org">XAMPP per Linux</a> (<code>/opt/lampp/htdocs/</code>)</li>
    <li><a href="https://www.apachefriends.org">XAMPP per Windows</a> (<code>C:\xampp\htdocs</code></li>
    <li><a href="https://www.apachefriends.org">XAMPP per Mac</a> (<code>/Applications/XAMPP/htdocs/</code>)</li>
    <li><a href="https://www.wampserver.com">Wampserver</a> (<code>C:\wamp\www</code>)</li>
    <li><a href="https://www.mamp.info">Mamp per Windows</a> (<code>C:\MAMP\htdocs</code></li>
    <li><a href="https://www.mamp.info">Mamp per Mac</a> (<code>/Applications/MAMP/htdocs</code>)</li>
  </ul>
</li>

<li>
  <p>Creare un database vuoto denominato <code>cfcm</code> tramite software per il management di MySQL (HeidiSQL, Navicat, MySQL Workbench), oppure PHPMyAdmin oppure da riga di comando.</p>
</li>
<li>
<p>Sempre utilizzando Navicat, HeidiSQL o Workbench esegui lo script cfcm.sql presente nel pacchetto della release per fare il restore nel db vuoto che avete appena creato</p>
</li>
<li>
<p>Con un editor di testo aprire il file DBManager.php presente in /Modello/ ed editare la linea <code>self::$db = new PDO( 'mysql:host=localhost;dbname=cfcm', 'NOME-UTENTE', 'PASSWORD' );</code> aggiungendo la propria username e password per collegarsi al server MySQL</p>
</li>
<li>
  <p>Aprire il browser e collegarsi a <code>http://127.0.0.1/cfcm/</code> e loggarsi con <code>username: admin</code> e <code>password: admin</code></p>
</li>
</ol>

<h2>Configurazione</h2>
Infine vi sono alcune configurazioni da effettuare tra cui:
<ol>
<li>Aprire il file php.ini e abilitare l'estensione gd togliendo il punto e virgola alla stringa ;extension=gd per decommentarla</li>
<li>
    <p>Accedere al gestionale e recarsi nella sezione "Amministrazione/Azienda" ed aggiungere una nuova azienda per inserire le 
      informazioni che verrano successivamente stampate nel footer della copertina dei Report pdf.</p>
</li>

<li>
    <p>Infine dopo averlo opportunamente modificato a seconda dei propri path e delle proprie credenziali và schedulato lo script <code>Upd-Zip-Bkp.cmd</code> presente nella cartella "Script" utilizzando o l'utilità di pianificazione di windows oppure un software di terze parti come <a href="https://www.splinterware.com/products/scheduler.html" target="_blank">System Scheduler</a> per la schedulazione ed esecuzione di script</p>
  </li>
  <li>
    <p>A questo punto è tutto pronto per poter procedere all'utilizzo</p>
  </li>
</ol>

<h2>Generazione di reports PDF</h2>
<p>E' in corso l'integrazione della libreria mpdf per la generazione di pdf direttamente da CFCM senza l'appoggio di applicazioni di terze parti come PdfCreator</p>

<h2>Donazioni</h2>
<p>
  Se CFCM ti è stato utile e vuoi offrirmi un caffè puoi farlo seguendo il link qui sotto: <br> 
  <a href="https://www.paypal.com/donate?hosted_button_id=7D5ZJXRNCYUJC" target="_blank">Donazione PayPal</a>
</p>

