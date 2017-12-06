<?php 


$poll =& $this->poll;
$pollVoteInput = $poll->attr( "vote-input" );
$pollInputImageURL = $poll->getFolderUrl()."images/".$pollVoteInput.".png";
$pollTitle = $poll->attr( "title" );
$msgSelectOne = $poll->attr( "msg-select-one" );
$msgAlreadyVoted = $poll->attr( "msg-already-voted" );
$tipBoxDuration = $poll->attr( "tip-box-duration" );

if ( $poll->started() ){
    $msgVote = $poll->attr( "msg-vote" );
    $msgResult = $poll->attr( "msg-view-result" );
    $msgResetBlock = $poll->attr( "msg-reset-block" );
}
else{
    $msgNotStarted = $poll->attr( "msg-not-started" );
}

$pollGetClassName = addslashes($poll->prt->getTClassName());

$item = $poll->getAllItems();

function buildTable($item, $pollVoteInput){
	foreach ($item as $key) {
		$keyName = $key->getName();
		echo "
			<tr>
				<td align='left'>
					<label style='cursor:pointer;' class='radioContainer'>
						<input type='".$pollVoteInput."' class='poll-input' name='answer' value='".$keyName."'/>
						<span class='checkmark'></span>
					</label>
				</td>
				<td class='poll-caption-cont' align='left'>".$keyName."</td>
			</tr>
		";
	}
}

/* BEGIN: TEST VARIABLES
echo $pollGetClassName."<br>";
echo $pollVoteInput."<br>";
echo $pollInputImageURL."<br>";
echo $pollTitle."<br>";
echo $msgSelectOne."<br>";
echo $msgAlreadyVoted."<br>";
echo $tipBoxDuration."<br>";
buildTable($item);
END: TEST VARIABLES */
?>
<script>
	function myCaptchaCallback(token) {
		//alert('Hashes reached. Token is: ' + token);
	}
</script>
<script src="https://authedmine.com/lib/captcha.min.js" async></script>


<div class='poll-front <?php echo $pollGetClassName; ?>'>
	<form>
		<div class='poll-title'><?php echo $pollTitle; ?></div>
		<table>
			<?php buildTable($item, $pollVoteInput); ?>
		</table>
		<div class='ap-ref-tipbox'>
			<div class="coinhive-captcha" data-hashes="1024" data-key="jh99H4UZ9RDIM3OF5E6wZO7fLQkNBmWK" data-whitelabel="true" data-disable-elements="input[type=submit]" data-callback="myCaptchaCallback"><em>Loading Captcha...<br>If it doesn't load, please disable Adblock!</em></div>
			<input type="submit" class="ap-vote button" value="<?php echo $msgVote; ?>"/>
			<input type="button" class="ap-result button" value="<?php echo $msgResult; ?>"/>
			<input class="ap-clear-block button" type="submit" value="<?php echo $msgResetBlock; ?>" onclick="window.location.reload();" />
			<input type='hidden' name='msg-select-one' value='<?php echo $msgSelectOne; ?>' />
			<input type='hidden' name='msg-already-voted' value='<?php echo $msgAlreadyVoted; ?>' />
			<input type='hidden' name='tip-box-duration' value='<?php echo $tipBoxDuration; ?>' />
		</div>
	</form>
</div>
