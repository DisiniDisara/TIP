"use strict"

function createAccountValidation(){
    var givenName = document.getElementById("givenName").value
    var familyName = document.getElementById("familyName").value
    var contactNo = document.getElementById("contactNo").value
    var hoursAvailible = document.getElementById("hoursAvailible").value
    var qualifications = document.getElementById("qualification").value

    var errMsg = ""
    var result = true


    if (givenName == ""){
        errMsg += "Error: Please fill out given name \n"
        result = false
    } else if (!givenName.match("^[a-zA-Z]{2,20}$")){
        errMsg += "Error: Given name must be alpha characters, between 2-20 in length.\n"
        result = false

    }

    if (familyName == ""){
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
    if (!qualifications.match("^\w{1,255}$")){
        errMsg += "Error: Qualifications cannot exceed 255 characters.\n"
        result = false
    }
    return errMsg

}

function validateAvailability(){
    var errMsg = ''

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

    validateStartEnd(monstart, monend)
    validateStartEnd(tuesstart, tuesend)
    validateStartEnd(wedstart, wedend)
    validateStartEnd(thursstart, thursend)
    validateStartEnd(fristart, friend)

}

function validateStartEnd(startTime, endTime){
    endTime = endTime.replace(':','')
    startTime = startTime.replace(':','')
    errMsg = ""

    if (number(startTime) > number(endTime)){
        errMsg += "Error: Start Time must be less than End Time."
        return errMsg
    }

return errMsg
}

if (document.title == "Availability"){
window.onsubmit = validateAvailability;
}

if (document.title == "User Details"){
window.onsubmit = createAccountValidation;
}
