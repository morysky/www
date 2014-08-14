///import core
///import commands\inserthtml.js
///commands 图片
/**
 * Created by .
 * User: zhuwenxuan
 * Date: 11-8-25
 * Time: 下午2:03
 * To change this template use File | Settings | File Templates.
 */
(function (){
    var domUtils = baidu.editor.dom.domUtils;
    baidu.editor.commands['insertimage'] = {
        execCommand : function (cmd, opt){
            var range = this.selection.getRange(),
                    img = range.getClosedNode(),
                    span;
            if(img && /img/ig.test( img.tagName )){
                if(img.className != "edui-faked-video" ){
                    domUtils.setAttributes(img,opt);
                }
            }else{
                span = this.document.createElement("span");
                img = this.document.createElement("img");
                domUtils.setAttributes(img,opt);
                span.appendChild(img);
                this.execCommand("inserthtml",span.innerHTML);
            }
        }
    };
})();
