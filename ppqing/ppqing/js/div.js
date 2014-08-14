function NeatDialog(sHTML, sTitle, bCancel) {   
    window.neatDialog = null;   
    this.elt = null;   
    if (document.createElement && document.getElementById) {   
        var dg = document.createElement("div");   
        dg.className = "neat-dialog";   
        if (sTitle) {   
            sHTML = "<div neat-dialog-title\">" + sTitle + (bCancel ? "<img src=\"x.gif\" alt=\"Cancel\" nd-cancel\" />" : "") + "</div>\n" + sHTML;   
        }   
        dg.innerHTML = sHTML;   
        var dbg = document.createElement("div");   
        dbg.id = "nd-bdg";   
        dbg.className = "neat-dialog-bg";   
        var dgc = document.createElement("div");   
        dgc.className = "neat-dialog-cont";   
        dgc.appendChild(dbg);   
        dgc.appendChild(dg);   
        if (document.body.offsetLeft > 0) {   
            dgc.style.marginLeft = document.body.offsetLeft + "px";   
        }   
        document.body.appendChild(dgc);   
        if (bCancel) {   
            document.getElementById("nd-cancel").onclick = function () {window.neatDialog.close();};   
        }   
        this.elt = dgc;   
        window.neatDialog = this;   
    }   
} 