// PopUp Msg

function close_PopUpMsg() {
    document.getElementById('Popup_msg').style.display = 'none';
    document.getElementById('body-elements').classList.remove('body_blured')
  }

function sendPopUpMessage(message) {
    if (message) {
      document.getElementById('popup_msg_Message').textContent = message;
      document.getElementById('Popup_msg').style.display = 'block';
      document.getElementById('body-elements').classList.add('body_blured')
      
    }
}


