<div class="row">
    <div class="col-md-6 mx-auto">
        <h2 class="text-center mt-4">Manage Polls</h2>
        <hr class="underTitle mb-4" />

        <form method="POST" action="">
            <h3 class="mt-4">Insert Poll</h3>

            <div class="form-group">
                <input type="text" name="tbPollName" id="tbPollName" placeholder="Question" class="form-control">
            </div>
            <div class="form-group">
                <textarea id="taAnswers" rows="6" class="form-control" placeholder="Separate the answers with SEMICOLON"></textarea>
            </div>
            <input type="button" value="Insert" name="btnAddPoll" id="btnAddPoll" class="btn btn-outline-success">

            <div id="errorsPoll">
            </div>

            <hr class="underTitle mb-4" />
            <h3>Activate Poll</h3>

            <div class="form-group">
                <select name="ddlActivatePoll" id="ddlActivatePoll" class="form-control">
                </select>
            </div>
            <input type="button" value="Save" name="btnActivatePoll" id="btnActivatePoll" class="btn btn-outline-success">

            <div id="activatePoll">
            </div>

            <hr class="underTitle mb-4" />
            <h3>Poll Results</h3>

            <div class="form-group">
                <select name="ddlPollResult" id="ddlPollResult" class="form-control">
                </select>
            </div>
            <input type="button" value="Show" name="btnPollResult" id="btnPollResult" class="btn btn-outline-success">

            <div id="pollResultAdmin">
            </div>
        </form>
    </div>
</div>