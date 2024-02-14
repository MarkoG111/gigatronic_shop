getPolls()

function getPolls() {
    $.ajax({
        url: "models/polls/ajaxAllPolls.php",
        method: "POST",
        dataType: "json",
        success: function (data) {
            printPolls(data);
            printActivePolls(data);
        },
        error: function (xhr, status, error) {
            console.log(xhr.status);
            console.log(error);
        }
    })
}

function printPolls(data) {
    let print = "<option value='0'>Choose</option>"

    for (let i of data) {
        print += `
        <option value="${i.idPoll}">${i.question}</option>
        `
    }

    $("#ddlPollResult").html(print);
}

function printActivePolls(data) {
    let print = "<option value='0'>Choose</option>";

    for (let i of data) {
        if (i.active == 1) {
            print += `
            <option value="${i.idPoll}" selected>${i.question}</option>
            `
        } else {
            print += `
            <option value="${i.idPoll}">${i.question}</option>
            `
        }

    }

    $("#ddlActivatePoll").html(print);
}

function printPollResults(data) {
    let print = `
    <table class='table table-striped table-dark mt-4'>
        <tr>
            <td class='table-heading'>Answers</td>
            <td class='table-heading'>Number of votes</td>
        </tr>
    `;

    for (let i of data) {
        print += `
        <tr>
            <td>${i.answer}</td>
            <td>${i.num}</td>
        </tr>
        `
    }

    print += `</table>`;

    return print;
}

$("#btnVote").click(function () {
    let id = $("#hiddenUserPollField").val();
    let answer = $("input[name='rbPoll']:checked").val();

    if (!answer) {
        $("#votingResults").html("You must choose answer.");
    } else {
        $.ajax({
            url: "models/polls/voting.php",
            method: "POST",
            dataType: "json",
            data: {
                id: id,
                answer: answer,
                send: true
            },
            success: function (data) {
                $("#votingResults").html(data.message);
            },
            error: function (xhr, status, error) {
                switch (xhr.status) {
                    case 409:
                        $("#votingResults").html("You aleready voted.");
                        break;
                    default:
                        console.log(xhr.status);
                        console.log(error);
                        break;
                }
            }
        })
    }
})

$("#btnVotingResult").click(function () {
    let id = $("#activePoll").val();

    $.ajax({
        url: "models/polls/showPoll.php",
        method: "POST",
        dataType: "json",
        data: {
            id: id,
            send: true
        },
        success: function (data) {
            $("#votingResults").html(printPollResults(data));
            console.log(data);
        },
        error: function (xhr, status, error) {
            console.log(xhr.status);
            console.log(error);
        }
    })
})

$("#btnAddPoll").click(function () {
    let pollName = $("#tbPollName").val().trim();
    let answer = $("#taAnswers").val().trim();
    let answers = answer.split(";");

    let errors = [];

    let print = "";

    let regOverall = /^([\wŠĐŽĆČčćžšđ\d\.\?])+(\s[\wŠĐŽĆČčćžšđ\d\.\?]+)*$/;

    if (!regOverall.test(pollName)) {
        errors.push("Question is not in good format.");
    }

    if (answer == "") {
        errors.push("Answer can't be blank.");
    } else {
        for (let i = 0; i < answers.length; i++) {
            if (!regOverall.test(answers[i].trim())) {
                errors.push("Answer is not in good format.");
            }
        }
    }

    if (errors.length) {
        for (let error of errors) {
            print += error + "<br/>";
        }

        $("#errorsPoll").html(print);
    } else {
        $("#errorsPoll").html("");

        $.ajax({
            url: "models/polls/insertPoll.php",
            method: "POST",
            dataType: "json",
            data: {
                name: pollName,
                answers: answers,
                send: true
            },
            success: function (data) {
                $("#errorsPoll").html(data.message);
                getPolls();
            },
            error: function (xhr, status, error) {
                console.log(xhr.status);
                console.log(error);
            }
        })
    }
})

$("#btnActivatePoll").click(function () {
    let id = $("#ddlActivatePoll").val();

    if (id != 0) {
        $.ajax({
            url: "models/polls/activatePoll.php",
            method: "POST",
            data: {
                id: id,
                send: true
            },
            success: function (data) {
                $("#activatePoll").html(data.message);

                getPolls();
            },
            error: function (xhr, status, error) {
                console.log(xhr.status);
                console.log(error);
            }
        })
    }
})

$("#btnPollResult").click(function () {
    let id = $("#ddlPollResult").val();

    if (id != 0) {
        $.ajax({
            url: "models/polls/showPoll.php",
            method: "POST",
            data: {
                id: id,
                send: true
            },
            success: function (data) {
                $("#pollResultAdmin").html(printPollResults(data));
            },
            error: function (xhr, status, error) {
                console.log(xhr.status);
                console.log(error);
            }
        })
    }
})