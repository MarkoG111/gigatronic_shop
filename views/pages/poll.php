<div class="container">
    <div class="row align-item-center">
        <div class="col-md-6 mx-auto" id="poll">
            <h2 class="text-center mt-4">Poll</h2>
            <hr class="underTitle mb-4" />
            <?php $poll = getActivePoll(); ?>

            <h3>
                <?php
                if ($poll) {
                    echo $poll->question;
                } else {
                    echo "There is no active poll at the moment.";
                }
                ?>
            </h3>

            <form action="" method="POST" class="form-horizontal" id="formVoting">
                <?php
                $queryAnswers = getActivePollAnswers();
                foreach ($queryAnswers as $answer) :
                ?>
                    <div class="radioButtons">
                        <label>
                            <input type="radio" name="rbPoll" class="rbPoll" value="<?= $answer->idAnswer ?>"> <?= $answer->answer ?>
                        </label>
                    </div>
                <?php endforeach; ?>

                <input type="hidden" id="hiddenUserPollField" value="<?= $_SESSION['user']->idUser ?>">
                <input type="hidden" id="activePoll" value="<?= $poll->idPoll ?>">
            </form>

            <div class="buttons">
                <button class="btn btn-outline-success" id="btnVote" type="button">Vote</button>
                <button class="btn btn-outline-success" id="btnVotingResult">Results</button>
            </div>

            <div id="votingResults">

            </div>
        </div>
    </div>
</div>