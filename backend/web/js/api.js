var ajaxOption = {
    type: "POST",
    dataType: 'json',
    async: true,//异步
    urlType: 1,
    wait: true,//菊花
};
var API = {
    sessions: 0,
    in_baseURI: "http://localhost/pageagent/frontend/web/site/api/",
    send: function (url, data, succ, err, options, model) {
        options = _.extend(_.clone(ajaxOption), options);
        url = this.in_baseURI + url;

        var onLoading = function () {
            API.sessions++;
            var loading = $("#loading");
            if (options.wait) {
                loading.show();
            }
        };

        var onDone = function () {
            API.sessions--;
            var loading = $("#loading");
            if (API.sessions == 0) {
                loading.hide();
            }
        };

        onLoading();

        $.ajax({
            type: options.type,
            url: url,
            data: data,
            async: options.async,
            cache: false,
            dataType: options.dataType,
            success: function (data) {
                if (_.isFunction(succ))    succ.call(model, data);
                onDone();
            },
            error: function (data) {
                if (_.isFunction(err)) {
                    err.call(model, data);
                } else if (_.isFunction(ApiCallBack_err)) {
                    ApiCallBack_err();
                }
                if (model && model.err != err && _.isFunction(model.err)) { // 公共错误处理
                    model.err(data);
                }
                onDone();
            },
        });
    },
    pageagentbackend: {
        //成为经纪人
    	createagent: function (data, succ, err, options, model) {
            var url = "pageagent/create_agent";
            var options = options ? options : {};
            API.send(url, data, succ, err, options, model);
        },
      //根据项目来源和项目id生成主页来源表
    	createhome: function (data, succ, err, options, model) {
            var url = "pageagent/create_home";
            var options = options ? options : {};
            API.send(url, data, succ, err, options, model);
        },
        createloupan: function (data, succ, err, options, model) {
            var url = "pageagent/create_loupan";
            var options = options ? options : {};
            API.send(url, data, succ, err, options, model);
        },
        createques: function (data, succ, err, options, model) {
            var url = "pageagent/create_ques";
            var options = options ? options : {};
            API.send(url, data, succ, err, options, model);
        },
        addvisit: function (data, succ, err, options, model) {
            var url = "pageagent/add_new_num";
            var options = options ? options : {};
            API.send(url, data, succ, err, options, model);
        },
    }

}
function ApiCallBack_err() {

}