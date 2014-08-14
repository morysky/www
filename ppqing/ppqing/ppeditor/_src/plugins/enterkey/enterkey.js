///import core
///import plugins/undo/undo.js
///commands 设置回车标签p或br
/**
 * @description 处理回车
 * @author zhanyi
 */
(function() {

    var browser = baidu.editor.browser,
        domUtils = baidu.editor.dom.domUtils,
        hTag ;
    baidu.editor.plugins['enterkey'] = function() {
        var me = this,
            tag = me.options.enterTag,
            flag = 0,
            inlineParents;
        me.addListener( 'keyup', function( type, evt ) {

            var keyCode = evt.keyCode || evt.which;
            if ( keyCode == 13 ) {
                var range = me.selection.getRange(),
                    start = range.startContainer,
                    doSave;

                //修正在h1-h6里边回车后不能嵌套p的问题
                if(!browser.ie){
                     if(/h\d/i.test(hTag) ){
                        if(browser.gecko){
                            var h = domUtils.findParentByTagName(start,[ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6','blockquote'],true);
                            if(!h){
                                me.document.execCommand( 'formatBlock', false, '<p>' );
                                doSave = 1;
                            }
                        }else{
                            //chrome remove div
                            if(start.nodeType == 1 ){
                                var tmp = me.document.createTextNode(''),div;
                                range.insertNode(tmp);
                                div = domUtils.findParentByTagName(tmp,'div',true);
                                if(div){
                                    var p = me.document.createElement('p');
                                    while(div.firstChild){
                                        p.appendChild(div.firstChild);
                                    }
                                    div.parentNode.insertBefore(p,div);
                                    domUtils.remove(div);
                                    range.setStartBefore(tmp).setCursor();
                                    doSave = 1;
                                }
                                domUtils.remove(tmp);

                            }
                        }




                    }
//                    //处理chrome下在list下回车不会添加新的li的问题
//                    if(browser.webkit){
//                        var li = domUtils.findParentByTagName(start,'li',true);
//                        if(li){
//
//                            var first = li.firstChild;
//                            if(domUtils.isBlockElm(first)){
//                                if(domUtils.isEmptyNode(first) && !li.nextSibling){
//                                    p = me.document.createElement('p');
//                                    var list = li.parentNode;
//                                    domUtils.remove(li);
//                                    list.parentNode.insertBefore(p,list.nextSibling);
//                                    range.setStart(p,0).setCursor();
//
//                                }else{
//                                    var newLi = me.document.createElement('li');
//
//                                    li.parentNode.insertBefore(newLi,li.nextSibling);
//
//                                    while(first != li.lastChild){
//                                        newLi.insertBefore(li.lastChild,newLi.firstChild);
//
//                                    }
//                                     range.setStart(newLi.firstChild,0).setCursor();
//
//                                }
//                            }
//
//
//
//                        }
//                    }
                }

                //修正回车不能把inline样式绑定下来的问题
                if( me.options.enterTag == 'p' && inlineParents && inlineParents.length>0){

                    if(!range.startOffset && start.nodeType == 1 &&  domUtils.isBlockElm(start)){
                        if(domUtils.isEmptyNode(start)){

                            var frag = me.document.createDocumentFragment(),
                            level = frag,
                            node;
                            while((node = inlineParents.pop()) && node.nodeType == 1 ){

                                level.appendChild(node.cloneNode(false));
                                level = level.firstChild;
                            }
                            if(frag.firstChild){
                                start.innerHTML = '';
                                range.insertNode(frag).setStart(level,0).setCursor();
                                doSave = 1;
                            }
                        }

                    }



                }
                if ( me.undoManger && doSave ) {
                    me.undoManger.save()
                }

                range = me.selection.getRange();
                setTimeout(function(){
                    range.scrollToView(me.autoHeightEnabled,me.autoHeightEnabled ? domUtils.getXY(me.iframe).y:0);
                },50)

            }
        } );

        me.addListener( 'keypress', function( type, evt ) {
            var keyCode = evt.keyCode || evt.which;
            if ( keyCode == 13 ) {//回车
                hTag = '';
                //chrome 在回车时，保存现场会有问题
                if ( me.undoManger ) {
                    me.undoManger.save()
                }
                var range = me.selection.getRange();
                inlineParents = [];
                range.shrinkBoundary();

                //修正ff不能把内联样式放到新的换行里的问题,先记录有那些节点
                if( range.collapsed){
                     inlineParents = domUtils.findParents(range.startContainer,true,function(node){
                        return node.nodeType == 1 && !domUtils.isBlockElm(node) && node.tagName != 'A' //a不加入到回车中
                    },true)
                }

                //li不处理
                if ( domUtils.findParentByTagName( range.startContainer, ['ol','ul'], true ) && !browser.webkit) {
                    return;
                }


                if ( !range.collapsed ) {
                    //跨td不能删
                    var start = range.startContainer,
                        end = range.endContainer,
                        startTd = domUtils.findParentByTagName( start, 'td', true ),
                        endTd = domUtils.findParentByTagName( end, 'td', true );
                    if ( startTd && endTd && startTd !== endTd || !startTd && endTd || startTd && !endTd ) {
                        evt.preventDefault ? evt.preventDefault() : ( evt.returnValue = false);
                        return;
                    }
                }
               me.currentSelectedArr && domUtils.clearSelectedArr(me.currentSelectedArr);

                if ( tag == 'p' ) {


                    if ( !browser.ie ) {

                        start = domUtils.findParentByTagName( range.startContainer, ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6','blockquote'], true );


                        if ( !start ) {
                            me.document.execCommand( 'formatBlock', false, '<p>' );
                            if ( browser.gecko ) {
                                range = me.selection.getRange();
                                start = domUtils.findParentByTagName( range.startContainer, 'p', true );
                                start && domUtils.removeDirtyAttr( start );
                            }

                        } else {
                            hTag = start.tagName;
                            start.tagName.toLowerCase() == 'p' && browser.gecko && domUtils.removeDirtyAttr( start );
                        }

                    }

                } else {
                    evt.preventDefault ? evt.preventDefault() : ( evt.returnValue = false);
                    if ( !range.collapsed ) {
                        range.deleteContents();
                        start = range.startContainer;
                        if ( start.nodeType == 1 && (start = start.childNodes[range.startOffset]) ) {
                            while ( start.nodeType == 1 ) {
                                if ( baidu.editor.dom.dtd.$empty[start.tagName] ) {
                                    range.setStartBefore( start ).setCursor();
                                    if ( me.undoManger ) {
                                        me.undoManger.save()
                                    }
                                    return false;
                                }
                                if ( !start.firstChild ) {
                                    var br = range.document.createElement( 'br' );
                                    start.appendChild( br );
                                    range.setStart( start, 0 ).setCursor();
                                    if ( me.undoManger ) {
                                        me.undoManger.save()
                                    }
                                    return false;
                                }
                                start = start.firstChild
                            }
                            if ( start === range.startContainer.childNodes[range.startOffset] ) {
                                br = range.document.createElement( 'br' );
                                range.insertNode( br ).setCursor();

                            } else {
                                range.setStart( start, 0 ).setCursor();
                            }


                        } else {
                            br = range.document.createElement( 'br' );
                            range.insertNode( br ).setStartAfter( br ).setCursor();
                        }


                    } else {
                        br = range.document.createElement( 'br' );
                        range.insertNode( br );
                        var parent = br.parentNode;
                        if ( parent.lastChild === br ) {
                            br.parentNode.insertBefore( br.cloneNode( true ), br );
                            range.setStartBefore( br )
                        } else {
                            range.setStartAfter( br )
                        }
                        range.setCursor();

                    }

                }

                //处理chrome下在list下回车不会添加新的li的问题
                if(browser.webkit){
                    if(!range.collapsed){
                        me.document.execCommand('delete');
                    }

                    var rng = me.selection.getRange();
                    var li = domUtils.findParentByTagName(rng.startContainer,'li',true);
                    if(li){
                        
                        var first = domUtils.isBlockElm(li.firstChild) ? li.firstChild : li;

                            if(domUtils.isEmptyNode(first) ){
                                var list = li.parentNode;
                                if(li.nextSibling){
                                   list =li.parentNode;
                                   domUtils.breakParent(li,list);
                                    list = li.previousSibling;
                                }
                                var p = me.document.createElement('p');
                                p.innerHTML = '<br/>';
                                domUtils.remove(li);
                                list.parentNode.insertBefore(p,list.nextSibling);
                                range.setStart(p,0).setCursor();

                            }else{


                                var span = me.document.createElement('span');
                                
                                rng.insertNode(span);
                                domUtils.breakParent(span,li);
                                var nextLi = span.nextSibling;
                                first = nextLi.firstChild;

                                if(!first){
                                    p = me.document.createElement('p');
                                    p.innerHTML = '<br/>';
                                    nextLi.appendChild(p);
                                    first = p;
                                }
                                if(domUtils.isEmptyNode(first)){
                                    first.innerHTML = '<br/>'
                                }
                                range.setStart(first,0).setCursor();
                                domUtils.remove(span);

                            }
                        
                        evt.preventDefault();
                        if(me.undoManger ) {
                            me.undoManger.save()
                        }
                        return;


                    }

                }

                if (  me.undoManger ) {
                    me.undoManger.save()
                }
            }
        } );
    }

})();
