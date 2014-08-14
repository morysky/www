///import core
///commands 添加分页功能
/**
 * @description 添加分页功能
 * @author zhanyi
 */
(function() {

    var editor = baidu.editor,
        domUtils = editor.dom.domUtils,
        notBreakTags = ['td'];

    baidu.editor.plugins['pagebreak'] = function() {
        var me = this;
        me.commands['pagebreak'] = {
            execCommand:function(){
                var range = me.selection.getRange();
                range.collapse(true);
                var div = me.document.createElement('div');
                div.className = 'pagebreak';
                domUtils.unselectable(div);
                //table单独处理
                var node = domUtils.findParentByTagName(range.startContainer,notBreakTags,true),
                    bk = range.createBookmark(),
                    parents = [],pN;
                if(node){
                    switch (node.tagName){
                        case 'TD':
                            var pN = node.parentNode;
                            if(!pN.previousSibling){
                                var table = domUtils.findParentByTagName(pN,'table');
                                table.parentNode.insertBefore(div,table);
                                parents = domUtils.findParents(div,true);
                                
                            }else{
                                pN.parentNode.insertBefore(div,pN);
                                parents = domUtils.findParents(div);

                            }
                            pN = parents[1];
                            if(div!==pN){
                                domUtils.breakParent(div,pN);
                            }

                            range.moveToBookmark(bk).select();
                            domUtils.clearSelectedArr(me.currentSelectedArr);
                    }
                    
                }else{
                    parents = domUtils.findParents(range.startContainer,true);
                    pN = parents[1];
                    range.insertNode(div);
                    domUtils.breakParent(div,pN);
                    range.moveToBookmark(bk).select()

                }
                
            }
        }

     
    }

})();
