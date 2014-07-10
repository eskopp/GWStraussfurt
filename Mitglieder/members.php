<table class="pure-table pure-table-horizontal">
    <thead>
        <tr>
            <th>Mitgliedernummer</th>
            <th>Name</th>
            <th>DWZ</th>
            <th>ELO</th>
        </tr>
    </thead>

    <tbody>
<?php
 	$xml = simplexml_load_file('xxx'); /* Link wurde entfernt */
	foreach($xml->Spieler as $member){
		$name = $member->vorname.' '.$member->nachname;
		$membernumber = $member->mglnr;
		$dwz = $member->dwz;
		$elo = $member->fideelo;
		echo('<tr>');
		echo('<td>'.$membernumber.'</td>');
		echo('<td>'.$name.'</td>');
		echo('<td>'.$dwz.'</td>');
		echo('<td>'.$elo.'</td>');
		echo('</tr>');
	}
?>
    </tbody>
</table>