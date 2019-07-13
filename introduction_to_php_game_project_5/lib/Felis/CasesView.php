<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/16
 * Time: 8:26 PM
 */

namespace Felis;


class CasesView extends View
{
    public function __construct(Site $site){
        $this->setTitle("Felis Cases");
        $this->addLink("staff.php", "Staff");
        $this->site = $site;
    }
    public function present(){
        $html = <<<HTML
<form class="table" action="post/cases.php" method="post">
	<p>
	<input type="submit" name="add" id="add" value="Add">
	<input type="submit" name="delete" id="delete" value="Delete">
	</p>

	<table>
		<tr>
			<th>&nbsp;</th>
			<th>Case Number</th>
			<th>Client</th>
			<th>Agent In Charge</th>
			<th class="desc">Description</th>
			<th>Most Recent Report</th>
			<th>Status</th>
		</tr>
HTML;
        $cases = new Cases($this->site);
        $all = $cases->getCases();
        foreach($all as $case) {
            $id = $case->getId();
            $num = $case->getNumber();
            $client = $case->getClientName();
            $agent = $case->getAgentName();
            $summary = $case->getSummary();
            $open = $case->getStatus() === ClientCase::STATUS_OPEN ?
                "Open" : "Closed";

            $html .= <<<HTML
		<tr>
			<td><input type="radio" name="user" value="$id"></td>
			<td><a href="case.php?id=$id">$num</a></td>
			<td>$client</td>
			<td>$agent</td>
			<td class="desc"><div>$summary</div></td>
			<td></td>
			<td>$open</td>
		</tr>
HTML;
        }
        $html.=<<<HTML
	</table>
</form>
HTML;
        return $html;
    }
    private $site;

}