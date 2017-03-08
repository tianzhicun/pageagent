var ajaxOption = {
    type: "POST",
    dataType: 'json',
    async: true,//异步
    urlType: 1,
    wait: true,//菊花
};
var API = {
    sessions: 0,
    in_baseURI: js_root + "site/api/",
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
    pageagent: {
        //获取项目列表
        getprolist: function (data, succ, err, options, model) {
            var url = "pageagent/get_pro_list";
            var options = options ? options : {};
            API.send(url, data, succ, err, options, model);
        },
        //创建项目
        createpro: function (data, succ, err, options, model) {
            var url = "pageagent/create_pro";
            var options = options ? options : {};
            API.send(url, data, succ, err, options, model);
        },
      //获取链接
        getlinklist: function (data, succ, err, options, model) {
            var url = "pageagent/get_link_list";
            var options = options ? options : {};
            API.send(url, data, succ, err, options, model);
        },
        //创建链接
        createlink: function (data, succ, err, options, model) {
            var url = "pageagent/create_link";
            var options = options ? options : {};
            API.send(url, data, succ, err, options, model);
        },
      //获取二维码
        geterweimalist: function (data, succ, err, options, model) {
            var url = "pageagent/get_erweima_list";
            var options = options ? options : {};
            API.send(url, data, succ, err, options, model);
        },
        //创建二维码
        createerweima: function (data, succ, err, options, model) {
            var url = "pageagent/create_erweima";
            var options = options ? options : {};
            API.send(url, data, succ, err, options, model);
        },
      //开发商绑定项目
        bindpro: function (data, succ, err, options, model) {
            var url = "pageagent/bind_pro";
            var options = options ? options : {};
            API.send(url, data, succ, err, options, model);
        },
      //活动绑定项目
        bindact: function (data, succ, err, options, model) {
            var url = "pageagent/bind_act";
            var options = options ? options : {};
            API.send(url, data, succ, err, options, model);
        },
        //获取来源列表
        gethomelist: function (data, succ, err, options, model) {
            var url = "pageagent/get_home_list";
            var options = options ? options : {};
            API.send(url, data, succ, err, options, model);
        },
        //获取经纪人列表getjjrlist
        getjjrlist: function (data, succ, err, options, model) {
            var url = "pageagent/get_jjr_list";
            var options = options ? options : {};
            API.send(url, data, succ, err, options, model);
        },
      //获取楼盘列表
        getloupanlist: function (data, succ, err, options, model) {
            var url = "pageagent/get_loupan_list";
            var options = options ? options : {};
            API.send(url, data, succ, err, options, model);
        },
      //获取提问列表
        getqueslist: function (data, succ, err, options, model) {
            var url = "pageagent/get_ques_list";
            var options = options ? options : {};
            API.send(url, data, succ, err, options, model);
        },
    }

}
function ApiCallBack_err() {

}