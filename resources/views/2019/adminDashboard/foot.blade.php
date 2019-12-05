
<!-- Jquery JS-->
<script src="/2019/adminDashboard/vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap JS-->
<script src="/2019/adminDashboard/vendor/bootstrap-4.1/popper.min.js"></script>
<script src="/2019/adminDashboard/vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
<script src="/2019/adminDashboard/vendor/slick/slick.min.js"></script>
<script src="/2019/adminDashboard/vendor/wow/wow.min.js"></script>
<script src="/2019/adminDashboard/vendor/animsition/animsition.min.js"></script>
<script src="/2019/adminDashboard/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<script src="/2019/adminDashboard/vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="/2019/adminDashboard/vendor/counter-up/jquery.counterup.min.js"></script>
<script src="/2019/adminDashboard/vendor/circle-progress/circle-progress.min.js"></script>
<script src="/2019/adminDashboard/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="/2019/adminDashboard/vendor/chartjs/Chart.bundle.min.js"></script>
<script src="/2019/adminDashboard/vendor/select2/select2.min.js"></script>
<!-- Main JS-->
<script src="/2019/adminDashboard/js/main.js"></script>
<script>
    var xport = {
        _fallbacktoCSV: true,
        toXLS: function(tableId, filename) {
            this._filename = (typeof filename == 'undefined') ? tableId : filename;

            //var ieVersion = this._getMsieVersion();
            //Fallback to CSV for IE & Edge
            if ((this._getMsieVersion() || this._isFirefox()) && this._fallbacktoCSV) {
                return this.toCSV(tableId);
            } else if (this._getMsieVersion() || this._isFirefox()) {
                alert("Not supported browser");
            }

            //Other Browser can download xls
            var htmltable = document.getElementById(tableId);
            var html = htmltable.outerHTML;

            this._downloadAnchor("data:application/vnd.ms-excel" + encodeURIComponent(html), 'xls');
        },
        toCSV: function(tableId, filename) {
            this._filename = (typeof filename === 'undefined') ? tableId : filename;
            // Generate our CSV string from out HTML Table
            var csv = this._tableToCSV(document.getElementById(tableId));
            // Create a CSV Blob
            var blob = new Blob([csv], { type: "text/csv" });

            // Determine which approach to take for the download
            if (navigator.msSaveOrOpenBlob) {
                // Works for Internet Explorer and Microsoft Edge
                navigator.msSaveOrOpenBlob(blob, this.filename + ".csv");
            } else {
                this._downloadAnchor(URL.createObjectURL(blob), 'csv');
            }
        },
        _getMsieVersion: function() {
            var ua = window.navigator.userAgent;

            var msie = ua.indexOf("MSIE ");
            if (msie > 0) {
                // IE 10 or older => return version number
                return parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)), 10);
            }

            var trident = ua.indexOf("Trident/");
            if (trident > 0) {
                // IE 11 => return version number
                var rv = ua.indexOf("rv:");
                return parseInt(ua.substring(rv + 3, ua.indexOf(".", rv)), 10);
            }

            var edge = ua.indexOf("Edge/");
            if (edge > 0) {
                // Edge (IE 12+) => return version number
                return parseInt(ua.substring(edge + 5, ua.indexOf(".", edge)), 10);
            }

            // other browser
            return false;
        },
        _isFirefox: function(){
            if (navigator.userAgent.indexOf("Firefox") > 0) {
                return 1;
            }

            return 0;
        },
        _downloadAnchor: function(content, ext) {
            var anchor = document.createElement("a");
            anchor.style = "display:none !important";
            anchor.id = "downloadanchor";
            document.body.appendChild(anchor);

            // If the [download] attribute is supported, try to use it

            if ("download" in anchor) {
                anchor.download = this._filename + "." + ext;
            }
            anchor.href = content;
            anchor.click();
            anchor.remove();
        },
        _tableToCSV: function(table) {
            // We'll be co-opting `slice` to create arrays
            var slice = Array.prototype.slice;

            return slice
                .call(table.rows)
                .map(function(row) {
                    return slice
                        .call(row.cells)
                        .map(function(cell) {
                            return '"t"'.replace("t", cell.textContent);
                        })
                        .join(",");
                })
                .join("\r\n");
        }
    };

</script>


<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="/2019/MDB-Free_4.8.8/js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="/2019/MDB-Free_4.8.8/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="/2019/MDB-Free_4.8.8/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="/2019/MDB-Free_4.8.8/js/mdb.min.js"></script>
<!-- MDBootstrap Datatables  -->
<script type="text/javascript" src="/2019/MDB-Free_4.8.8/js/addons/datatables.js"></script>
<script>
    $(document).ready(function () {
        $('#Untitled').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
</script>