@extends('layouts.shop')
@section('content')
    <script>
        $(function () {
            $("#categories").addClass("active-item");
        });
    </script>
    <!--  Page Content  -->
    <div id="page-content">
        <!--  Page header  -->
        <div class="container">
            <div class="row no-margin">
                <div class="col-md-12 padding-leftright-null">
                    <div id="page-header">
                        <div class="text text-center">
                            {{--//标题（需要dom标签）--}}
                            <h1 class="margin-bottom-small">

                                <span class="color">.</span></h1>
                            {{--//发表时间 小时+8--}}
                            <span class="post-meta">

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  END Page header  -->
        <div id="home-wrap" class="content-section">

            <div class="container">
                <hr style="border: solid">
            </div>
            <!-- Post Content -->
            <div class="container">
                <div class="row no-margin wrap-text padding-bottom-null padding-onlytop-lg">
                    <div class="col-md-8 col-md-offset-2 padding-leftright-null">
                        <div class="text small padding-topbottom-null">
                            <span class="dropcap" data-dropcap="DLartist"></span>
                            {{--//文章内容（无需dom标签）--}}
                            <p>本文翻译来自<a href="https://link.jianshu.com?t=https://github.com/froala/wysiwyg-editor" rel="nofollow" target="_blank">wysiwyg-editor</a>，大家想看原文可以点击此链接。</p>

                            <h2>介绍</h2>

                            <p><a href="https://link.jianshu.com?t=https://www.froala.com/wysiwyg-editor" rel="nofollow" target="_blank">WYSIWYG HTML编辑器</a>是一款有史以来最强大的JavaScript富文本编辑器之一。它采用了最新的技术，并利用jQuery和HTML5的巨大优势，创造了出色的编辑体验。拥有非常多的示例让你轻松集成，让你的用户爱上它清晰的设计。它能和Ruby On Rails，Django，Angular.js，Meteor，Symgony.CakePHP等集成，具有如下特点。</p>

                            <ul>
                                <li>微小 - 只需添加您需要的插件(<a href="https://link.jianshu.com?t=https://www.froala.com/wysiwyg-editor/docs/plugins" rel="nofollow" target="_blank">30+ 官方插件</a>)</li>
                                <li><a href="https://link.jianshu.com?t=https://www.froala.com/wysiwyg-editor/docs/framework-plugins/" rel="nofollow" target="_blank">客户端框架集成</a></li>
                                <li>可以向如 <a href="https://link.jianshu.com?t=https://www.froala.com/wysiwyg-editor/docs/sdks/php" rel="nofollow" target="_blank">PHP</a>,
                                    <a href="https://link.jianshu.com?t=https://www.froala.com/wysiwyg-editor/docs/sdks/nodejs" rel="nofollow" target="_blank"></a><a href="Node.JS">Node.JS</a>, &nbsp;<a href="https://link.jianshu.com?t=https://www.froala.com/wysiwyg-editor/docs/sdks/dotnet" rel="nofollow" target="_blank">.NET</a>, <a href="https://link.jianshu.com?t=https://www.froala.com/wysiwyg-editor/docs/sdks/java" rel="nofollow" target="_blank">Java</a>, 和 <a href="https://link.jianshu.com?t=https://www.froala.com/wysiwyg-editor/docs/sdks/python" rel="nofollow" target="_blank">Python</a>提供服务端开发工具包</li>
                                <li>代码注释精美</li>
                                <li><a href="https://link.jianshu.com?t=https://www.froala.com/wysiwyg-editor/docs" rel="nofollow" target="_blank">在线文档更新</a></li>
                                <li>简单可扩展- 良好的插件注释使你更容易使用和开发自己的插件</li>
                                <li>良好的维护 - <a href="https://link.jianshu.com?t=https://www.froala.com/wysiwyg-editor/changelog" rel="nofollow" target="_blank">持续更新</a></li>
                                <li>很好的支持 - <a href="https://link.jianshu.com?t=https://wysiwyg-editor.froala.help" rel="nofollow" target="_blank">帮助中心</a></li>
                            </ul>

                            <p><img data-original-src="//upload-images.jianshu.io/upload_images/6492270-68b322ee022a97a7.jpg" data-original-width="2000" data-original-height="1000" data-original-format="image/jpeg" data-original-filesize="347338" src="//upload-images.jianshu.io/upload_images/6492270-68b322ee022a97a7.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1000/format/webp" class="fr-fil fr-dib"></p>

                            <p>WYSIWYG HTML Editor</p>

                            <p>
                                <br>
                            </p>

                            <h2>演示</h2>

                            <ul>
                                <li><strong>基本演示</strong>:
                                    <a href="https://link.jianshu.com?t=https://www.froala.com/wysiwyg-editor" rel="nofollow" target="_blank"></a><a href="https://www.froala.com/wysiwyg-editor">https://www.froala.com/wysiwyg-editor</a></li>
                                <li><strong>在线演示</strong>:
                                    <a href="https://link.jianshu.com?t=https://www.froala.com/wysiwyg-editor/inline" rel="nofollow" target="_blank"></a><a href="https://www.froala.com/wysiwyg-editor/inline">https://www.froala.com/wysiwyg-editor/inline</a></li>
                                <li><strong>完整列表</strong>:
                                    <a href="https://link.jianshu.com?t=https://www.froala.com/wysiwyg-editor/examples" rel="nofollow" target="_blank"></a><a href="https://www.froala.com/wysiwyg-editor/examples">https://www.froala.com/wysiwyg-editor/examples</a>
                                    <br>
                                </li>
                            </ul>

                            <h2>开始使用</h2>

                            <h3>初始化编辑器</h3>

                            <p>Froala WYSIWYG HTML编辑器是一个易于集成和易于使用的插件。它需要<a href="https://link.jianshu.com?t=http://jquery.com/" rel="nofollow" target="_blank">jQuery</a> 1.11.0或更高版本，以及名为<a href="https://link.jianshu.com?t=http://fortawesome.github.io/Font-Awesome/" rel="nofollow" target="_blank">Font Awesome</a> 4.4.0的图标字体。你也可以使用旧版本的Font Awesome，但是某些编辑器的图标将不会出现。</p>

                            <p>下面是如何在textarea上初始化编辑器的基本示例。</p><pre><code>&lt;!DOCTYPE html&gt;
&lt;html&gt;
 &lt;head&gt;
 &lt;meta charset=&quot;utf-8&quot;&gt;
 &lt;!-- Include external CSS. --&gt;
 &lt;link href=&quot;https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; /&gt;
 &lt;link rel=&quot;stylesheet&quot; href=&quot;https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css&quot;&gt;
 &lt;!-- Include Editor style. --&gt;
 &lt;link href=&quot;https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0/css/froala_editor.pkgd.min.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; /&gt;
 &lt;link href=&quot;https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0/css/froala_style.min.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; /&gt;
 &lt;/head&gt;
 &lt;body&gt;
 &lt;!-- Create a tag that we will use as the editable area. --&gt;
 &lt;!-- You can use a div tag as well. --&gt;
 &lt;textarea&gt;&lt;/textarea&gt;
 &lt;!-- Include external JS libs. --&gt;
 &lt;script type=&quot;text/javascript&quot; src=&quot;https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js&quot;&gt;&lt;/script&gt;
 &lt;script type=&quot;text/javascript&quot; src=&quot;https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js&quot;&gt;&lt;/script&gt;
 &lt;script type=&quot;text/javascript&quot; src=&quot;https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js&quot;&gt;&lt;/script&gt;
 &lt;!-- Include Editor JS files. --&gt;
 &lt;script type=&quot;text/javascript&quot; src=&quot;https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0/js/froala_editor.pkgd.min.js&quot;&gt;&lt;/script&gt;
 &lt;!-- Initialize the editor. --&gt;
 &lt;script&gt;
 $(function() { $(&#39;textarea&#39;).froalaEditor() }); &lt;/script&gt;
 &lt;/body&gt;
&lt;/html&gt;
</code></pre>

                            <h3>显示编辑内容</h3>

                            <p>要在富文本编辑器之外保留编辑过的HTML的样式，你必须引入以下CSS文件。</p><pre><code>&lt;!-- CSS rules for styling the element inside the editor such as p, h1, h2, etc. --&gt;
&lt;link href=&quot;../css/froala_style.min.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot; /&gt;
</code></pre>

                            <p>此外，你应该确保将编辑的内容放在类名为fr-view元素中。</p><pre><code>&lt;div class=&quot;fr-view&quot;&gt;
 Here comes the HTML edited with the Froala rich text editor.
&lt;/div&gt;
</code></pre>

                            <h3>举个栗子</h3>

                            <p>在此富文本编辑器中，你可以在块级元素之间随意拖动图片，具体代码如下。</p>

                            <p>HTML</p><pre><code>&lt;div id=&quot;froala-editor&quot;&gt;
 &lt;h3&gt;Click here to edit the content&lt;/h3&gt;
 &lt;p&gt;![](/assets/editor/docs/photo14.jpg)&lt;/p&gt;
 &lt;p&gt;The image can be dragged only between blocks and not inside them.&lt;/p&gt;
&lt;/div&gt;
</code></pre>

                            <p>JAVASCRIPT</p><pre><code>&lt;script&gt;
 $(function() { $(&#39;div#froala-editor&#39;).froalaEditor({ dragInline: false, toolbarButtons: [&#39;bold&#39;, &#39;italic&#39;, &#39;underline&#39;, &#39;insertImage&#39;, &#39;insertLink&#39;, &#39;undo&#39;, &#39;redo&#39;], pluginsEnabled: [&#39;image&#39;, &#39;link&#39;, &#39;draggable&#39;] }) });
&lt;/script&gt;
</code></pre>

                            <p>效果图如下所示。</p>

                            <p><img data-original-src="//upload-images.jianshu.io/upload_images/6492270-996d2426d75a8170.gif" data-original-width="503" data-original-height="397" data-original-format="image/gif" data-original-filesize="275437" src="//upload-images.jianshu.io/upload_images/6492270-996d2426d75a8170.gif?imageMogr2/auto-orient/strip%7CimageView2/2/w/503/format/webp" class="fr-fil fr-dib"></p>

                            <p>WYSIWYG HTML Editor</p>

                            <p>有关自定义编辑器的详细信息，请查看编辑器<a href="https://link.jianshu.com?t=https://www.froala.com/wysiwyg-editor/docs" rel="nofollow" target="_blank">文档</a>。
                                <br>
                            </p>

                            <h2>相关下载</h2>

                            <ul>
                                <li>npm: <code>npm install froala-editor</code></li>
                                <li>bower: <code>bower install froala-wysiwyg-editor</code></li>
                                <li>CDN:
                                    <a href="https://link.jianshu.com?t=https://cdnjs.com/libraries/froala-editor" rel="nofollow" target="_blank"></a><a href="https://cdnjs.com/libraries/froala-editor">https://cdnjs.com/libraries/froala-editor</a></li>
                                <li>Angular JS:
                                    <a href="https://link.jianshu.com?t=https://github.com/froala/angular-froala" rel="nofollow" target="_blank"></a><a href="https://github.com/froala/angular-froala">https://github.com/froala/angular-froala</a></li>
                                <li>Angular 2:
                                    <a href="https://link.jianshu.com?t=https://github.com/froala/angular2-froala-wysiwyg" rel="nofollow" target="_blank"></a><a href="https://github.com/froala/angular2-froala-wysiwyg">https://github.com/froala/angular2-froala-wysiwyg</a></li>
                                <li>Aurelia:
                                    <a href="https://link.jianshu.com?t=https://github.com/froala/aurelia-froala-editor" rel="nofollow" target="_blank"></a><a href="https://github.com/froala/aurelia-froala-editor">https://github.com/froala/aurelia-froala-editor</a></li>
                                <li>CakePHP:
                                    <a href="https://link.jianshu.com?t=https://github.com/froala/wysiwyg-cake" rel="nofollow" target="_blank"></a><a href="https://github.com/froala/wysiwyg-cake">https://github.com/froala/wysiwyg-cake</a></li>
                                <li>Django:
                                    <a href="https://link.jianshu.com?t=https://github.com/froala/django-froala-editor" rel="nofollow" target="_blank"></a><a href="https://github.com/froala/django-froala-editor">https://github.com/froala/django-froala-editor</a></li>
                                <li>Ember:
                                    <a href="https://link.jianshu.com?t=https://github.com/froala/ember-froala-editor" rel="nofollow" target="_blank"></a><a href="https://github.com/froala/ember-froala-editor">https://github.com/froala/ember-froala-editor</a></li>
                                <li>Knockout:
                                    <a href="https://link.jianshu.com?t=https://github.com/froala/knockout-froala" rel="nofollow" target="_blank"></a><a href="https://github.com/froala/knockout-froala">https://github.com/froala/knockout-froala</a></li>
                                <li>Meteor:
                                    <a href="https://link.jianshu.com?t=https://github.com/froala/meteor-froala" rel="nofollow" target="_blank"></a><a href="https://github.com/froala/meteor-froala">https://github.com/froala/meteor-froala</a></li>
                                <li>Ruby on Rails:
                                    <a href="https://link.jianshu.com?t=https://github.com/froala/wysiwyg-rails" rel="nofollow" target="_blank"></a><a href="https://github.com/froala/wysiwyg-rails">https://github.com/froala/wysiwyg-rails</a></li>
                                <li>React JS:
                                    <a href="https://link.jianshu.com?t=https://github.com/froala/react-froala-wysiwyg/" rel="nofollow" target="_blank"></a><a href="https://github.com/froala/react-froala-wysiwyg/">https://github.com/froala/react-froala-wysiwyg/</a></li>
                                <li>Reactive:
                                    <a href="https://link.jianshu.com?t=https://github.com/froala/froala-reactive" rel="nofollow" target="_blank"></a><a href="https://github.com/froala/froala-reactive">https://github.com/froala/froala-reactive</a></li>
                                <li>Symfony:
                                    <a href="https://link.jianshu.com?t=https://github.com/froala/KMSFroalaEditorBundle" rel="nofollow" target="_blank"></a><a href="https://github.com/froala/KMSFroalaEditorBundle">https://github.com/froala/KMSFroalaEditorBundle</a></li>
                                <li>Vue JS:
                                    <a href="https://link.jianshu.com?t=https://github.com/froala/vue-froala-wysiwyg/" rel="nofollow" target="_blank"></a><a href="https://github.com/froala/vue-froala-wysiwyg/">https://github.com/froala/vue-froala-wysiwyg/</a></li>
                                <li>Yii2:
                                    <a href="https://link.jianshu.com?t=https://github.com/froala/yii2-froala-editor" rel="nofollow" target="_blank"></a><a href="https://github.com/froala/yii2-froala-editor">https://github.com/froala/yii2-froala-editor</a></li>
                                <li>Wordpress:
                                    <a href="https://link.jianshu.com?t=https://github.com/froala/wordpress-froala-wysiwyg" rel="nofollow" target="_blank"></a><a href="https://github.com/froala/wordpress-froala-wysiwyg">https://github.com/froala/wordpress-froala-wysiwyg</a>
                                    <br>
                                </li>
                            </ul>

                            <h2>浏览器支持</h2>

                            <p>我们正在积极测试编辑器在所有主要浏览器兼容性。在下面列出的浏览器中，如有任何问题请当作bug反馈到我们的GitHub库。</p>

                            <ul>
                                <li>Internet Explorer 10+</li>
                                <li>Safari 6+</li>
                                <li>Firefox (Current - 1) and Current versions</li>
                                <li>Chrome (Current - 1) and Current versions</li>
                                <li>Opera (Current - 1) and Current versions</li>
                                <li>iOS 7.0+</li>
                                <li>Android 4.0+</li>
                            </ul>

                            <h2>资源</h2>

                            <ul>
                                <li>演示：
                                    <a href="https://link.jianshu.com?t=http://www.froala.com/wysiwyg-editor" rel="nofollow" target="_blank"></a><a href="www.froala.com/wysiwyg-editor">www.froala.com/wysiwyg-editor</a></li>
                                <li>下载页面：
                                    <a href="https://link.jianshu.com?t=https://www.froala.com/wysiwyg-editor/download" rel="nofollow" target="_blank"></a><a href="www.froala.com/wysiwyg-editor/download">www.froala.com/wysiwyg-editor/download</a></li>
                                <li>文档：
                                    <a href="https://link.jianshu.com?t=https://www.froala.com/wysiwyg-editor/docs" rel="nofollow" target="_blank"></a><a href="froala.com/wysiwyg-editor/docs">froala.com/wysiwyg-editor/docs</a></li>
                                <li>授权协议：
                                    <a href="https://link.jianshu.com?t=https://www.froala.com/wysiwyg-editor/terms" rel="nofollow" target="_blank"></a><a href="www.froala.com/wysiwyg-editor/terms">www.froala.com/wysiwyg-editor/terms</a></li>
                                <li>帮助： <a href="https://link.jianshu.com?t=https://wysiwyg-editor.froala.help/hc/en-us" rel="nofollow" target="_blank">wysiwyg-editor.froala.help</a></li>
                                <li>问题：<a href="https://link.jianshu.com?t=https://github.com/highcharts/highcharts/blob/master/repo-guidelines.md" rel="nofollow" target="_blank">Repo guidelines</a>
                                    <br>
                                </li>
                            </ul>

                            <h2>问题报告</h2>

                            <p>我们使用GitHub中的问题作为Froala WYSIWYG HTML编辑器的官方错误跟踪器，以下是我们希望报告问题的用户的一些建议：</p>

                            <ol>
                                <li>确保您使用的是最新版本的Froala WYSIWYG Editor。 您即将报告的问题可能已在最新的主分支版本中已经修复：https：//github.com/froala/froala-wysiwyg/tree/master/js。</li>
                                <li>为问题提供可复写的步骤将会缩短解决时间。<a href="https://link.jianshu.com?t=https://jsfiddle.net" rel="nofollow" target="_blank">JSFiddle</a>总是受欢迎的。</li>
                                <li>某些问题可能是浏览器特定的，因此在您遇到问题中指定浏览器可能会有所帮助。</li>
                            </ol>

                            <h2>技术支持或问题</h2>

                            <p>如果您有任何问题或需要帮助，请与我们<a href="https://link.jianshu.com?t=https://www.froala.com/wysiwyg-editor/contact" rel="nofollow" target="_blank">联系</a>。</p>

                            <h2>许可</h2>

                            <p>为了使用Froala编辑器，您必须根据需求购买以下许可证之一。 您可以在我们的网站上的<a href="https://link.jianshu.com?t=https://www.froala.com/wysiwyg-editor/pricing" rel="nofollow" target="_blank">定价计划页面</a>找到更多信息。</p>

                            <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>

                            <p>小礼物走一走，来简书关注我</p>

                            <p>
                                <br>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
            <!-- END Post Content -->



            <div class="container">
                <hr style="border: solid">
            </div>

            <!-- Full width Border Separator -->
            <div class="row no-margin">
                <div class="border-separator"></div>
            </div>
            <!-- END Full Width Border Separator -->
            <div class="container">
                <!--  Comments  -->
                <div class="row no-margin wrap-text padding-onlytop-lg">
                    <div class="col-md-8 col-md-offset-2 padding-leftright-null">
                        <div class="text small padding-topbottom-null">
                            <div id="comments">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#tab-one" aria-controls="tab-one" role="tab" data-toggle="tab" aria-expanded="true">所有评论</a></li>
                                    <li role="presentation" class=""><a href="#tab-two" aria-controls="tab-two" role="tab" data-toggle="tab" aria-expanded="false">评论</a></li>
                                </ul>
                                <!--  Nav Tabs  -->
                                <!-- Tab panes -->
                                <div class="tab-content no-margin-bottom">
                                    <div role="tabpanel" class="tab-pane padding-md active" id="tab-one">
                                        <div class="comment">
                                            <div class="row margin-null">
                                                <div class="col-md-12 padding-leftright-null">
                                                    <img src="assets/img/comment3.jpg" alt="">
                                                    <div class="content">
                                                        <div class="header">
                                                                    <span class="comment-author">
                                                                        Asia Rossi
                                                                    </span>
                                                            <span class="comment-btn">
                                                                        <a href="#"><i class="material-icons">reply</i></a>
                                                                    </span>
                                                        </div>
                                                        <span class="comment-date">
                                                                    12 November 2017
                                                                </span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti quo fuga corporis sunt voluptate, quia, beatae voluptates est possimus impedit eveniet quaerat nulla sapiente. Omnis odit quas est fuga nam.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment reply">
                                            <div class="row margin-null">
                                                <div class="col-md-10 col-md-offset-2 padding-leftright-null">
                                                    <img src="assets/img/comment1.jpg" alt="">
                                                    <div class="content">
                                                        <div class="header">
                                                                    <span class="comment-author">
                                                                        Joe Doe
                                                                    </span>
                                                            <span class="comment-btn">
                                                                        <a href="#"><i class="material-icons">reply</i></a>
                                                                    </span>
                                                        </div>
                                                        <span class="comment-date">
                                                                    12 November 2017
                                                                </span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti quo fuga corporis sunt voluptate, quia, beatae voluptates est possimus impedit eveniet quaerat nulla sapiente. Omnis odit quas est fuga nam.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment">
                                            <div class="row">
                                                <div class="col-md-12 padding-leftright-null">
                                                    <img src="assets/img/comment2.jpg" alt="">
                                                    <div class="content">
                                                        <div class="header">
                                                                    <span class="comment-author">
                                                                        Jessica Brown
                                                                    </span>
                                                            <span class="comment-btn">
                                                                        <a href="#"><i class="material-icons">reply</i></a>
                                                                    </span>
                                                        </div>
                                                        <span class="comment-date">
                                                                    12 November 2017
                                                                </span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti quo fuga corporis sunt voluptate, quia, beatae voluptates est possimus impedit eveniet quaerat nulla sapiente. Omnis odit quas est fuga nam.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane padding-md" id="tab-two">
                                        <section class="comment-form">
                                            <form id="contact-form" name="comment">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="">评论<sup>*</sup></label>
                                                        <textarea class="form-field" name="messageForm" id="messageForm" rows="6" placeholder="Your Message"></textarea>
                                                        <div class="submit-area">
                                                            <input type="submit" id="submit-contact" class="btn-alt active" value="发表">
                                                            <div id="msg" class="message"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  END Comments  -->
            </div>
        </div>

        {{--//返回上一页--}}
        <div class="container">
            <!--  Navigation  -->
            <section id="nav" class="padding-onlytop-lg">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="nav-left">
                            <a href=”#” onClick="javascript :history.back(-1);" class="btn-alt small shadow margin-null"><i class="icon ion-ios-arrow-left"></i><span>返回</span></a>
                        </div>
                    </div>
                    {{--<div class="col-xs-6">--}}
                    {{--<div class="nav-right">--}}
                    {{--<a href="#" class="btn-alt small shadow margin-null"><span>Newer posts</span><i class="icon ion-ios-arrow-right"></i></a>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>
            </section>
        </div>

    </div>
    <!--  END Page Content -->
    </div>


@endsection