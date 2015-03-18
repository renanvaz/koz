/**
 *  CODE
 */

(function () {
    'use strict';

    var uReport, app, request;
    var prepare = function(group) {
        var status = true, item, i, l;

        for (i = 0, l = group.report.length; i < l; i++) {
            item = group.report[i];

            if (item.report) {
                prepare(item);
            }

            status = status && item.status;
            item.opened = !item.status;
        }

        group.status = status;
        group.opened = !group.status;
    };

    request = new XMLHttpRequest();
    request.open('GET', 'uReport.json', true);

    request.onload = function() {
      if (this.status >= 200 && this.status < 400) {
        uReport = JSON.parse(this.response);

        prepare(uReport);

        Vue.component('u-group', {
            template: document.querySelector('#u-group-template').innerHTML
        });

        app = new Vue({
            el: '#app',
            data: {
                styleOk: {width: ((uReport.summary.asserts.ok / (uReport.summary.asserts.ok + uReport.summary.asserts.nok)) * 100) + '%'},
                styleNok: {width: ((uReport.summary.asserts.nok / (uReport.summary.asserts.ok + uReport.summary.asserts.nok)) * 100) + '%'},
                uReport: uReport
            },
        });

        var codes = document.querySelectorAll('code'), i, l;
        for (i = 0, l = codes.length; i < l; i++) {
            hljs.highlightBlock(codes[i]);
        }
      } else {
        // We reached our target server, but it returned an error
      }
    };

    request.onerror = function() {
      // There was a connection error of some sort
    };

    request.send();
})();
