//>>built
define("dijit/layout/StackContainer","dojo/_base/array,dojo/cookie,dojo/_base/declare,dojo/dom-class,dojo/has,dojo/_base/lang,dojo/ready,dojo/topic,../registry,../_WidgetBase,./_LayoutWidget,dojo/i18n!../nls/common".split(","),function(f,h,d,g,j,k,l,e,i,m,n){j("dijit-legacy-requires")&&l(0,function(){require(["dijit/layout/StackController"])});d=d("dijit.layout.StackContainer",n,{doLayout:!0,persist:!1,baseClass:"dijitStackContainer",buildRendering:function(){this.inherited(arguments);g.add(this.domNode,
"dijitLayoutContainer");this.containerNode.setAttribute("role","tabpanel")},postCreate:function(){this.inherited(arguments);this.connect(this.domNode,"onkeypress",this._onKeyPress)},startup:function(){if(!this._started){var a=this.getChildren();f.forEach(a,this._setupChild,this);this.persist?this.selectedChildWidget=i.byId(h(this.id+"_selectedChild")):f.some(a,function(a){if(a.selected)this.selectedChildWidget=a;return a.selected},this);var b=this.selectedChildWidget;if(!b&&a[0])b=this.selectedChildWidget=
a[0],b.selected=!0;e.publish(this.id+"-startup",{children:a,selected:b});this.inherited(arguments)}},resize:function(){if(!this._hasBeenShown){this._hasBeenShown=!0;var a=this.selectedChildWidget;a&&this._showChild(a)}this.inherited(arguments)},_setupChild:function(a){this.inherited(arguments);g.replace(a.domNode,"dijitHidden","dijitVisible");a.domNode.title=""},addChild:function(a,b){this.inherited(arguments);this._started&&(e.publish(this.id+"-addChild",a,b),this.layout(),this.selectedChildWidget||
this.selectChild(a))},removeChild:function(a){this.inherited(arguments);this._started&&e.publish(this.id+"-removeChild",a);if(!this._descendantsBeingDestroyed){if(this.selectedChildWidget===a&&(this.selectedChildWidget=void 0,this._started)){var b=this.getChildren();b.length&&this.selectChild(b[0])}this._started&&this.layout()}},selectChild:function(a,b){a=i.byId(a);if(this.selectedChildWidget!=a){var c=this._transition(a,this.selectedChildWidget,b);this._set("selectedChildWidget",a);e.publish(this.id+
"-selectChild",a);this.persist&&h(this.id+"_selectedChild",this.selectedChildWidget.id)}return c},_transition:function(a,b){b&&this._hideChild(b);var c=this._showChild(a);a.resize&&(this.doLayout?a.resize(this._containerContentBox||this._contentBox):a.resize());return c},_adjacent:function(a){var b=this.getChildren(),c=f.indexOf(b,this.selectedChildWidget),c=c+(a?1:b.length-1);return b[c%b.length]},forward:function(){return this.selectChild(this._adjacent(!0),!0)},back:function(){return this.selectChild(this._adjacent(!1),
!0)},_onKeyPress:function(a){e.publish(this.id+"-containerKeyPress",{e:a,page:this})},layout:function(){var a=this.selectedChildWidget;a&&a.resize&&(this.doLayout?a.resize(this._containerContentBox||this._contentBox):a.resize())},_showChild:function(a){var b=this.getChildren();a.isFirstChild=a==b[0];a.isLastChild=a==b[b.length-1];a._set("selected",!0);g.replace(a.domNode,"dijitVisible","dijitHidden");return a._onShow&&a._onShow()||!0},_hideChild:function(a){a._set("selected",!1);g.replace(a.domNode,
"dijitHidden","dijitVisible");a.onHide&&a.onHide()},closeChild:function(a){a.onClose(this,a)&&(this.removeChild(a),a.destroyRecursive())},destroyDescendants:function(a){this._descendantsBeingDestroyed=!0;this.selectedChildWidget=void 0;f.forEach(this.getChildren(),function(b){a||this.removeChild(b);b.destroyRecursive(a)},this);this._descendantsBeingDestroyed=!1}});d.ChildWidgetProperties={selected:!1,disabled:!1,closable:!1,iconClass:"dijitNoIcon",showTitle:!0};k.extend(m,d.ChildWidgetProperties);
return d});