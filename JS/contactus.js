function emailSend() {
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var phone = document.getElementById('phone').value;
    var message = document.getElementById('message').value;

    var messageBody = "Name " + name +
        "<br/> Phone " + phone +
        "<br/> Email " + email +
        "<br/> Message " + message;

    Email.send({
        Host: "smtp.elasticemail.com",
        Username: "odparker14@gmail.com",
        Password: "D656D7BEF976B35E80D27BC9B113D4549DF3",
        To: '21-32788@g.batstate-u.edu.ph',
        From: "odparker14@gmail.com",
        Subject: "This is the subject",
        Body: messageBody
    }).then(
        message => {
            if (message === 'OK') {
                swal("Successful", "You clicked the button!", "success");
            } else {
                swal("Error", "You clicked the button!", "error");
            }
        }
    );
}