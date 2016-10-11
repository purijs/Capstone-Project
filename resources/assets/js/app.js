/**
 * Created by JaskaranSingh on 27-09-2016.
 */
angular.module("rsw",['rsw.controller']);
function notifyBrowser(title, desc) {

    if (Notification.permission !== "granted") {
        Notification.requestPermission();
    }
    else {
        var notification = new Notification(title, {
            body: desc,
        });
    }
}