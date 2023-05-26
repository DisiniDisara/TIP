"use strict"

function createAccountValidation(){
    var givenName = document.getElementById("givenName").value
    var familyName = document.getElementById("familyName").value
    var contactNo = document.getElementById("contactNo").value
    var hoursAvailible = document.getElementById("hoursAvailable").value
    var qualifications = document.getElementById("qualification").value

    var errMsg = ""
    var result = true


    if (givenName === ""){
        errMsg += "Error: Please fill out given name \n"
        result = false
    } else if (!givenName.match("^[a-zA-Z]{2,20}$")){
        errMsg += "Error: Given name must be alpha characters, between 2-20 in length.\n"
        result = false

    }

    if (familyName === ""){
        errMsg += "Error: Please fill out family name \n"
        result = false

    } else if (!familyName.match("^[a-zA-Z-]{2,20}$")){
        errMsg += "Error: Family name must be alpha characters and hyphens, between 2-20 in length. \n"
        result = false

    }

    if(!contactNo.match("[0-9\s]{8,12}")){
        errMsg += "Error: Phone number must be digits, between 8-12 in length, including spaces.\n"
        result = false

    }

    if (!hoursAvailible.match("^[0-9]{1,4}$")){
        errMsg += "Error: Hours availible can only be digits, up to four in length. You may be working too much.\n"
        result = false

    }
    if (!qualifications.match("^[a-zA-Z-\\s]{0,255}$")){
        errMsg += "Error: Qualifications cannot exceed 255 characters.\n"
        result = false
    }
    
    if (errMsg != "") {
        if (result == false){
        document.getElementById("errorCode").innerHTML = errMsg
        var error = document.getElementById("errorCodeHidden")
        error.setAttribute("value", errMsg)
        return result
        }
    }
    return result

}

function validateAvailability(){
    var errMsg = ''
    var result = true

    var monstart =document.getElementById("MondayStart").value
    var monend  = document.getElementById("MondayEnd").value

    var tuesstart =document.getElementById("TuesdayStart").value
    var tuesend  = document.getElementById("TuesdayEnd").value

    var wedstart =document.getElementById("WednesdayStart").value
    var wedend  = document.getElementById("WednesdayEnd").value

    var thursstart =document.getElementById("ThursdayStart").value
    var thursend  = document.getElementById("ThursdayEnd").value

    var fristart =document.getElementById("FridayStart").value
    var friend  = document.getElementById("FridayEnd").value

    monstart = monstart.replace(':','')
    monend = monend.replace(':','')
    tuesstart = tuesstart.replace(':','')
    tuesend = tuesend.replace(':','')
    wedstart = wedstart.replace(':','')
    wedend = wedend.replace(':','')
    thursstart = thursstart.replace(':','')
    thursend = thursend.replace(':','')
    fristart = fristart.replace(':','')
    friend = friend.replace(':','')

    if (Number(monstart) > Number(monend)){
        errMsg += "\nError: Monday Start Time must be less than End Time."
        result = false
    } if (Number(tuesstart) > Number(tuesend)){
        errMsg += "\nError: Tuesday Start Time must be less than End Time."
        result = false

    } if (Number(wedstart) > Number(wedend)){
                errMsg += "\nError: Wednesday Start Time must be less than End Time."
                result = false

    } if (Number(thursstart) > Number(thursend)){
                errMsg += "\nError: Thursday Start Time must be less than End Time."
                result = false

    } if (Number(fristart) > Number(friend)){
                errMsg += "\nError: Friday Start Time must be less than End Time."
                result = false

    }

    if (errMsg != "") {
        result = false
        document.getElementById("errorCode").innerHTML = errMsg
        var error = document.getElementById("errorCodeHidden")
        error.setAttribute("value", errMsg)
        }
    return result

}

function validateStartEnd(startTime, endTime){
    endTime = endTime.replace(':','')
    startTime = startTime.replace(':','')

    if (Number(startTime) > Number(endTime)){
        errMsg += "Error: Start Time must be less than End Time."
        return errMsg
    }

return errMsg
}

function init(){
var currentPage = document.title
if (currentPage == "Availability"){
    var element = document.getElementById("availabilityform")
    element.addEventListener("submit", function() {validateAvailability()})
}

if (currentPage == "User Details"){
    var element = document.getElementById("detailsform")
    element.addEventListener("submit", function() {createAccountValidation()})

}

if (currentPage == "Create Account"){
    var element = document.getElementById("createform")
    element.addEventListener("submit", function() {createAccountValidation()})
}

if (currentPage == "Details"){
    var element = document.getElementById("detailsform")
    element.addEventListener("submit", function() {createAccountValidation()})
}
}

window.onload=init;
window.onsubmit = init;
