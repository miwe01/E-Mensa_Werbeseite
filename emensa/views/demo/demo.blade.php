<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Demo</title>
    <style type="text/css">
        body { background-color: {{ '#' . $bgcolor }}; }
    </style>
</head>
<body>

<article>
<h1>Demo für {{ $name }}</h1>
<p>Kurze Übersicht, wie das mit dem Router und der Blade View-Engine funktioniert.</p>

<h2>Router</h2>
<p>Der Router nimmt den Request entgegen und zerlegt ihn in die einzelnen Teile der URI. Wichtig ist hier vor allem der Pfad und der Querystring.</p>
<p>Wenn der Pfad in der Routenkonfiguration (<code>\$config</code> Array aus der Datei <code>routes/web.php</code>) gefunden wird, lädt der Router die angegebene Klasse.</p>
<h3>Funktionsweise</h3>
<p>Im vorliegenden Beispiel sehen Sie diese Seite ... </p>
<ol>
    <li>weil der Pfad in der Routenkonfiguration gefunden wurde</li>
    <li>und dort <code>'DemoController@howto'</code> hinterlegt ist</li>
    <li>und im Ordner <code>controllers/</code> die Datei <code>DemoController.php</code> gefunden werden konnte</li>
    <li>und mit ihr ein Objekt des Typs <code>DemoController</code> instanziiert werden konnte</li>
    <li>und dieses Objekt die Funktion (Action) <code>howto()</code> ausgeführt hat</li>
</ol>
<p>Sie sehen: da muss einiges stimmen und vieles davon ist Konvention.</p>
<h3>Querystrings und Pfadsegmente</h3>
<p>Die Actions in den Controller-Klassen sollen per Konvention immer ein <code>RequestData</code> Objekt entgegennehmen. Beispiel: <code>howto(RequestData \$rd)</code></p>
<p>Dieses RequestData Objekt wird durch den Router befüllt, wenn Daten in der URL extrahiert werden konnten.</p>
<p>Daten finden sich URLs...</p>
<ol>
    <li><strong>im Querystring</strong><br>Beispiel: rufen Sie diese mit <code>/demo?<strong>bgcolor=fefbd8&name=Remmy</strong></code> auf, werden <code>bgcolor</code> und <code>hello</code> mitsamt Werten als Query Array <code>$rd->query</code>) übergeben</li>
</ol>
<p>Probieren Sie es aus ;)</p>
@if(count($rd->args))
<p><strong>Argumente dieses Aufrufs:</strong></p>

@forelse($rd->args as $a)
    <div><code>{{$a}}</code></div>
    @empty
    <p>Keine weiteren Argumente im Request</p>
@endforelse
@endif
@if(count($rd->query))
    <p><strong>Daten aus der Query dieses Aufrufs:</strong></p>
@forelse($rd->query as $k => $v)
    <div><code>$rd->query['{{$k}}']={{$v}}</code></div>
@empty
    <p>Keine Querydaten</p>
@endforelse
@endif
<h2>Blade</h2>
<p>Blade <a href="https://github.com/EFTEC/BladeOne#install-pick-one-of-the-next-one">muss installiert</a> sein.
Die Installation ist bereits geschehen und die Bibliothek liegt unter /vendor.
</p>
<h3>Daten übergeben und View rendern</h3>
<p>Bei der Verwendung der View-Engine gelten einige Konventionen:
    Die Dateien müssen <code>&lt;viewname&gt;.blade.php</code> heißen und im Ordner <code>views</code> liegen.
</p>
<p>Sie können der View dann Daten mitgeben, indem Sie alle Daten in ein Array schreiben und dieses dann übergeben.</p>
<p>Beispiel:</p>
<pre>
 view("viewtest",
    array(
        "texts"=>$textArray,
        "persona"=>$persona,
        "rd"=>$rd
    )); // öffnet ../views/viewtest.blade.php
</pre>
</article>
</body>
</html>