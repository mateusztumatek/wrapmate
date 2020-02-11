export function startDownload(url) {
    let imageURL = url;
    var downloadedImg = new Image;
    downloadedImg.crossOrigin = "Anonymous";
    downloadedImg.addEventListener("load", (data) => {
        console.log(data, "DATA");
    }, false);
    downloadedImg.src = imageURL;
}
