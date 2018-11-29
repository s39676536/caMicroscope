/**
 * Fetches data and returns an object.
 * @param options
 */
var OSDImageMetaData = new Class({
    initialize: function (options) {
        this.imageId = options.imageId;
        this.metaData = null;
        this.retrieveImageSize();
        this.temp = 2;
    },
    retrieveImageSize: function () {
        var jsonRequest = new Request.JSON({
            url: "/node/"+this.imageId+"?_format=json", async: false, onSuccess: function (e) {
                var yah = {};
                yah["mpp-x"] = e.field_mpp_x[0].value;
                yah["mpp-y"] = e.field_mpp_y[0].value;
                var pro = [];
                pro.push(yah);
                pro.push(e.field_iip_path[0].value+".dzi");
                console.log("erich : "+JSON.stringify(pro));
                this.metaData = pro;
            }.bind(this), onFailure: function (e) {
                alert("Failed to get dimension");
            }.bind(this)
        }).get();
    },
    oldretrieveImageSize: function () {
        var jsonRequest = new Request.JSON({
            url: "api/Data/osdMetadataRetriever.php", async: false, onSuccess: function (e) {
                this.metaData = e;
                console.log("erich meta "+e);
            }.bind(this), onFailure: function (e) {
                alert("Failed to get dimension");
            }.bind(this)
        }).get({'imageId': this.imageId});
    }
});
