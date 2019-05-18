if (app.scriptArgs.isDefined("file_path")) {
    var file_path = app.scriptArgs.getValue("file_path");
}
if (app.scriptArgs.isDefined("chose")) {
    var chose = app.scriptArgs.getValue("chose");
}
if (app.scriptArgs.isDefined("get_image_num")) {
    var get_image_num = app.scriptArgs.getValue("get_image_num");
}
if (app.scriptArgs.isDefined("get_pic")) {
    var get_pic = app.scriptArgs.getValue("get_pic");
}
if (app.scriptArgs.isDefined("R")) {
    var RED = app.scriptArgs.getValue("R");
}
if (app.scriptArgs.isDefined("G")) {
    var GREEN = app.scriptArgs.getValue("G");
}
if (app.scriptArgs.isDefined("B")) {
    var BLUE = app.scriptArgs.getValue("B");
}
if (app.scriptArgs.isDefined("text_title")) {
    var text_title = app.scriptArgs.getValue("text_title");
}
if (app.scriptArgs.isDefined("text_author")) {
    var text_author = app.scriptArgs.getValue("text_author");
}
if (app.scriptArgs.isDefined("text_content")) {
    var text_content = app.scriptArgs.getValue("text_content");
}
if (app.scriptArgs.isDefined("text_summary")) {
    var text_summary = app.scriptArgs.getValue("text_summary");
}
var AllColor=["1","2","3","4","5","6","7","8","9","10",
    "11","12","13","14","15","16","17","18","19","20",
    "21","22","23","24","25","26","27","28","29","30",
    "31","32","33","34","35","36","37","38","39","40",
    "41"];

var offset=0;
var index_content=0;
var bold=new Array();
var begin=0;
var col_index=0;

var R_num=0, G_num=0, B_num=0;
var R_get=new Array();
var G_get=new Array();
var B_get=new Array();
for(var i=0;i<1000;i++){
    R_get[i]=G_get[i]=B_get[i]=-1;
}
for(var i=0;i<RED.length;){
    if(i<RED.length&&RED[i]=="q"){
        R_num++;
        i++;
        R_get[R_num]="";
    }
    else while(i<RED.length&&RED[i]!="q"){
        R_get[R_num]+=RED[i];
        i++;
    }
}
for(var i=0;i<GREEN.length;){
    if(i<GREEN.length&&GREEN[i]=="q"){
        G_num++;
        i++;
        G_get[G_num]="";
    }
    else while(i<GREEN.length&&GREEN[i]!="q"){
        G_get[G_num]+=GREEN[i];
        i++;
    }
}
for(var i=0;i<BLUE.length;){
    if(i<BLUE.length&&BLUE[i]=="q"){
        B_num++;
        i++;
        B_get[B_num]="";
    }
    else while(i<BLUE.length&&BLUE[i]!="q"){
        B_get[B_num]+=BLUE[i];
        i++;
    }
}
for(var i=1;i<=1000;i++){
    R_get[i]=parseInt(R_get[i]);
    G_get[i]=parseInt(G_get[i]);
    B_get[i]=parseInt(B_get[i]);
}
R_num=1, G_num=1, B_num=1;

main(file_path,chose,get_image_num,get_pic,R_get,G_get,B_get,text_title,text_author,text_content,text_summary);
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function main(file_path,chose,get_image_num,get_pic,R,G,B,text_title,text_author,text_content,text_summary){
    var myDocument = app.documents.add();
    var n=10;
    var image_num=new Array(0,0,2,1,1,6,1,2);
    var image_get=new Array();
    var image_present=new Array();
    var first_page=true;
    for(i=0;i<1000;i++){
        image_get[i]=undefined;
        image_present[i]=false;
    }
    var num=0;//counter
    for(var i=0;i<get_pic.length;){
        if(i<get_pic.length&&get_pic[i]=="q"){
            num++;
            i++;
            image_get[num]="";
            image_present[num]=true;
        }
        else while(i<get_pic.length&&get_pic[i]!="q"){
            image_get[num]+=get_pic[i];
            i++;
        }
    }

    var num_get=1;
    var erase=false;
    while(chose>0){
        var ch=chose%n;
        chose=Math.floor(chose/n);
        if(first_page){
            if(ch==1){//3700 0
                model1(myDocument,text_title,text_author,text_summary,text_content,R,G,B);
            }
            else if(ch==2){//2398 2
                model2(myDocument,text_title,text_author,text_summary,text_content,R,G,B,image_get[num_get++],image_get[num_get++]);
            }
            else if(ch==3){//255 3
                model3(myDocument,text_title,text_author,text_summary,text_content,R,G,B,image_get[num_get++],image_get[num_get++],image_get[num_get++]);
            }
            else if(ch==4){//1900 1
                model4(myDocument,text_title,text_author,text_content,R,G,B,image_get[num_get++]);
            }
            else if(ch==5){//2698 1
                model5(myDocument,text_title,text_author,text_summary,text_content,R,G,B,image_get[num_get++]);
            }
            first_page=false;
        }
        else{
            erase=true;
            if(ch==6){//2040
                model6(myDocument,R,G,B,image_get[num_get++],image_get[num_get++],image_present[num_get-2],image_present[num_get-1]);
            }
            else if(ch==7){//4192
                model7(myDocument,image_get[num_get++],image_present[num_get-1]);
            }
            else if(ch==8){//2592
                model8(myDocument,R,G,B,image_get[num_get++],image_get[num_get++],image_present[num_get-2],image_present[num_get-1]);
            }
            else if(ch==9){//3415
                model9(myDocument,R,G,B,image_get[num_get++],image_get[num_get++],image_present[num_get-2],image_present[num_get-1]);
            }
        }
    }
    fit();
    if(erase){
        while(del(myDocument));
    }

    print(myDocument,file_path);
}
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function model1(myDocument,tfile,afile,sfile,cfile,R,G,B){//1612
    with(myDocument.documentPreferences){
        pageHeight = "297mm";
        pageWidth = "210mm";
        pageOrientation = PageOrientation.portrait;
        pagesPerDocument = 1;
    }
    var firstpage = myDocument.pages.item(0);
    firstpage.marginPreferences.properties = {
        top : 20,
        left: 20,
        right: 20,
        bottom:20
    };
    //-----------------------------------------------------------------------------------------------------------------------
    if(tfile==undefined){
        text = File("/C/Users/Administrator/Desktop/title.txt");
        text.open("r");
        titlefile="";
        titlefile+=text.read();
    }
    else {
        titlefile=tfile;
    }
    if(afile==undefined){
        text = File("/C/Users/Administrator/Desktop/author.txt");
        text.open("r");
        authorfile="";
        authorfile+=text.read();
    }
    else {
        authorfile=afile;
    }

    if(sfile==undefined){
        text = File("/C/Users/Administrator/Desktop/summary.txt");
        text.open("r");
        summaryfile="";
        summaryfile+=text.read();
    }
    else {
        summaryfile=sfile;
    }
    if(cfile==undefined){
        text = File("/C/Users/Administrator/Desktop/content.txt");
        text.open("r");
        contentfile="";
        contentfile+=text.read();
    }else {
        text = File(cfile);
        text.open("r");
        contentfile="";
        contentfile+=text.read();
    }

    color=makeColor(myDocument,AllColor[col_index++], ColorSpace.RGB, ColorModel.process, [R[R_num],G[G_num],B[B_num]]);
    //-----------------------------------------------------------------------------------------------------------------------
    color2 = color;
    //-----------------------------------------------------------------------------------------------------------------------
    page_line = myDocument.graphicLines.add();
    page_line.strokeWeight = 0.5;
    page_line.paths.item(0).pathPoints.item(0).anchor = [161, 278];
    page_line.paths.item(0).pathPoints.item(1).anchor = [161+29, 278];
    var page_num=firstpage.name;
    var page_footnote = firstpage.textFrames.add();
    page_footnote.geometricBounds = [280, 20, 280+7.5,20+170];
    page_footnote.contents =page_num+"    | "+titlefile;
    page_footnote.parentStory.paragraphs.item(0).pointSize = 8;
    page_footnote.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    page_footnote.parentStory.paragraphs.item(0).fontStyle = "Light"
    page_footnote.parentStory.paragraphs.item(0).justification=Justification.RIGHT_ALIGN;


    var title = firstpage.textFrames.add();
    title.geometricBounds = [22, 28,22+19, 28+150];
    title.contents =titlefile;
    title.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    title.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    title.parentStory.paragraphs.item(0).pointSize=26;

    Line1 = myDocument.graphicLines.add();
    Line1.strokeWeight = 0.5;
    Line1.paths.item(0).pathPoints.item(0).anchor = [28, 42.5];
    Line1.paths.item(0).pathPoints.item(1).anchor = [28+150, 42.5];

    var author = firstpage.textFrames.add();
    author.geometricBounds = [242.5, 20,242.5+8.5, 20+170];
    author.contents =authorfile;
    author.contents  = "";

    var summary = firstpage.textFrames.add();
    summary.geometricBounds = [45, 28, 45+32.5,28+150];
    summary.contents =summaryfile;
    summary.characters[0].fillColor = color2;
    summary.parentStory.paragraphs.item(0).dropCapCharacters =1;
    summary.parentStory.paragraphs.item(0).dropCapLines =2;
    summary.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    summary.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    summary.parentStory.paragraphs.item(0).pointSize = 12;

    Line2 = myDocument.graphicLines.add();
    Line2.strokeWeight = 0.5;
    Line2.paths.item(0).pathPoints.item(0).anchor = [28, 68];
    Line2.paths.item(0).pathPoints.item(1).anchor = [28+150,68];

    var text="";
    var times=0;
    for(var i=0;i<1000;i++){
        bold[i]=-1;
    }
    for(var i=0;i<contentfile.length;){
        if(i+3<contentfile.length&&contentfile[i]=="$"&&contentfile[i+1]=="s"&&contentfile[i+2]=="t"&&contentfile[i+3]=="$"){
            times++;
            i+=4;
            bold[index_content++]=i-4*times;
            while(!(contentfile[i]=="$"&&contentfile[i+1]=="/"&&contentfile[i+2]=="s"&&contentfile[i+3]=="$")||i>=contentfile.length){
                text+=contentfile[i];
                i++;
            }
            bold[index_content++]=i-4*times;
            times++;
            i+=4;
        }
        else{
            text+=contentfile[i];
            i++;
        }
    }
    var content = firstpage.textFrames.add();
    content.geometricBounds = [85, 27.3,85+183, 27.3+75.5];
    var content2 = firstpage.textFrames.add();
    content2.previousTextFrame = content;
    content2.geometricBounds = [85, 106.4,85+183, 106.4+75.5];
    content.contents =text;
    content.parentStory.paragraphs.item(0).leading=14;
    content.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    content.parentStory.paragraphs.item(0).fontStyle = "Light"
    content.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    content.parentStory.paragraphs.item(0).pointSize =8;
    var first_time_add=true;
    for(;begin<index_content;begin+=2){
        if(bold[begin+1]-1<=content.contents.length){
            content.characters.itemByRange(bold[begin], bold[begin+1]-1).appliedFont = app.fonts.itemByName("intel Clear Hans");
            content.characters.itemByRange(bold[begin], bold[begin+1]-1).fontStyle = "Bold"
        }
        else if(bold[begin+1]-1<=content.contents.length+content2.contents.length){
            if(first_time_add){
                first_time_add=false;
                offset+=content.contents.length;
            }
            content2.characters.itemByRange(bold[begin]-offset, bold[begin+1]-1-offset).appliedFont = app.fonts.itemByName("intel Clear Hans");
            content2.characters.itemByRange(bold[begin]-offset, bold[begin+1]-1-offset).fontStyle = "Bold"
        }
        else{break;}
    }
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function model2(myDocument,tfile,afile,sfile,cfile,R,G,B,p1,p2){//1472
    with(myDocument.documentPreferences){
        pageHeight = "297mm";
        pageWidth = "210mm";
        pageOrientation = PageOrientation.portrait;
        pagesPerDocument = 1;
    }
    var firstpage = myDocument.pages.item(0);
    firstpage.marginPreferences.properties = {
        top : 20,
        left: 20,
        right: 20,
        bottom:20
    };
    //-----------------------------------------------------------------------------------------------------------------------
    if(tfile==undefined){
        text = File("/C/Users/Administrator/Desktop/title.txt");
        text.open("r");
        titlefile="";
        titlefile+=text.read();
    }
    else {
        titlefile=tfile;
    }
    if(afile==undefined){
        text = File("/C/Users/Administrator/Desktop/author.txt");
        text.open("r");
        authorfile="";
        authorfile+=text.read();
    }
    else {
        authorfile=afile;
    }

    if(sfile==undefined){
        text = File("/C/Users/Administrator/Desktop/summary.txt");
        text.open("r");
        summaryfile="";
        summaryfile+=text.read();
    }
    else {
        summaryfile=sfile;
    }
    if(cfile==undefined){
        text = File("/C/Users/Administrator/Desktop/content.txt");
        text.open("r");
        contentfile="";
        contentfile+=text.read();
    }else {
        text = File(cfile);
        text.open("r");
        contentfile="";
        contentfile+=text.read();
    }

    if(p1==undefined)
        picture1 = File("/C/Users/Administrator/Desktop/content.txt");
    else picture1 = File (p1);
    picture1.open=("r");

    if(p2==undefined)
        picture2 = File("/C/Users/Administrator/Desktop/content.txt");
    else picture2 = File (p2);
    picture2.open=("r");

    color=makeColor(myDocument,AllColor[col_index++], ColorSpace.RGB, ColorModel.process, [R[R_num],G[G_num],B[B_num]]);
    R_num+=6;G_num+=6;B_num+=6;
    //-----------------------------------------------------------------------------------------------------------------------
    color2 = color;
    //-----------------------------------------------------------------------------------------------------------------------
    page_line = myDocument.graphicLines.add();
    page_line.strokeWeight = 0.5;
    page_line.paths.item(0).pathPoints.item(0).anchor = [161, 278];
    page_line.paths.item(0).pathPoints.item(1).anchor = [161+29, 278];
    var page_num=firstpage.name;
    var page_footnote = firstpage.textFrames.add();
    page_footnote.geometricBounds = [280, 20, 280+7.5,20+170];
    page_footnote.contents =page_num+"    | "+titlefile;
    page_footnote.parentStory.paragraphs.item(0).pointSize = 8;
    page_footnote.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    page_footnote.parentStory.paragraphs.item(0).fontStyle = "Light"
    page_footnote.parentStory.paragraphs.item(0).justification=Justification.RIGHT_ALIGN;


    var title = firstpage.textFrames.add();
    title.geometricBounds = [22, 28,22+19, 28+150];
    title.contents =titlefile;
    title.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    title.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    title.parentStory.paragraphs.item(0).pointSize=26;

    Line1 = myDocument.graphicLines.add();
    Line1.strokeWeight = 0.5;
    Line1.paths.item(0).pathPoints.item(0).anchor = [28, 42.5];
    Line1.paths.item(0).pathPoints.item(1).anchor = [28+150, 42.5];

    var author = firstpage.textFrames.add();
    author.geometricBounds = [242.5, 20,242.5+8.5, 20+170];
    author.contents =authorfile;
    author.contents  = "";

    var summary = firstpage.textFrames.add();
    summary.geometricBounds = [45, 28, 45+32.5,28+150];
    summary.contents =summaryfile;
    summary.characters[0].fillColor = color2;
    summary.parentStory.paragraphs.item(0).dropCapCharacters =1;
    summary.parentStory.paragraphs.item(0).dropCapLines =2;
    summary.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    summary.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    summary.parentStory.paragraphs.item(0).pointSize = 10;

    Line2 = myDocument.graphicLines.add();
    Line2.strokeWeight = 0.5;
    Line2.paths.item(0).pathPoints.item(0).anchor = [28, 68];
    Line2.paths.item(0).pathPoints.item(1).anchor = [28+150, 68];

    var text="";
    var times=0;
    for(var i=0;i<1000;i++){
        bold[i]=-1;
    }
    for(var i=0;i<contentfile.length;){
        if(i+3<contentfile.length&&contentfile[i]=="$"&&contentfile[i+1]=="s"&&contentfile[i+2]=="t"&&contentfile[i+3]=="$"){
            times++;
            i+=4;
            bold[index_content++]=i-4*times;
            while(!(contentfile[i]=="$"&&contentfile[i+1]=="/"&&contentfile[i+2]=="s"&&contentfile[i+3]=="$")||i>=contentfile.length){
                text+=contentfile[i];
                i++;
            }
            bold[index_content++]=i-4*times;
            times++;
            i+=4;
        }
        else{
            text+=contentfile[i];
            i++;
        }
    }
    var content = firstpage.textFrames.add();
    content.geometricBounds = [85, 27.3,85+183, 27.3+75.5];
    var content2 = firstpage.textFrames.add();
    content2.previousTextFrame = content;
    content2.geometricBounds = [85, 106.4,85+183, 106.4+75.5];
    content.contents =text;
    content.parentStory.paragraphs.item(0).leading=14;
    content.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    content.parentStory.paragraphs.item(0).fontStyle = "Light"
    content.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    content.parentStory.paragraphs.item(0).pointSize =8;
    var first_time_add=true;
    for(;begin<index_content;begin+=2){
        if(bold[begin+1]-1<=content.contents.length){
            content.characters.itemByRange(bold[begin], bold[begin+1]-1).appliedFont = app.fonts.itemByName("intel Clear Hans");
            content.characters.itemByRange(bold[begin], bold[begin+1]-1).fontStyle = "Bold"
        }
        else if(bold[begin+1]-1<=content.contents.length+content2.contents.length){
            if(first_time_add){
                first_time_add=false;
                offset+=content.contents.length;
            }
            content2.characters.itemByRange(bold[begin]-offset, bold[begin+1]-1-offset).appliedFont = app.fonts.itemByName("intel Clear Hans");
            content2.characters.itemByRange(bold[begin]-offset, bold[begin+1]-1-offset).fontStyle = "Bold"
        }
        else{break;}
    }

    //-----------------------------------------------------------------------------------------------------------------------
    if(p1!=undefined){
        var image1 = firstpage.rectangles.add({geometricBounds:[213 ,20, 213+54.9, 20+83.6]});
        image1.strokeWeight  = '0 pt'
        image1.place(picture1,false);
        image1.textWrapPreferences.textWrapMode = TextWrapModes.BOUNDING_BOX_TEXT_WRAP;
        image1.textWrapPreferences.textWrapOffset = [10,0,0,0];
    }
    if(p2!=undefined){
        var image2 = firstpage.rectangles.add({geometricBounds:[85 ,106.4, 85+54.9, 106.4+83.6]});
        image2.strokeWeight  = '0 pt'
        image2.place(picture2,false);
        image2.textWrapPreferences.textWrapMode = TextWrapModes.BOUNDING_BOX_TEXT_WRAP;
        image2.textWrapPreferences.textWrapOffset = [0,0,10,0];
    }
}


//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function model3(myDocument,tfile,afile,sfile,cfile,R,G,B,p1,p2,p3){//1389
    with(myDocument.documentPreferences){
        pageHeight = "297mm";
        pageWidth = "210mm";
        pageOrientation = PageOrientation.portrait;
        pagesPerDocument = 1;
    }
    var firstpage = myDocument.pages.item(0);
    firstpage.marginPreferences.properties = {
        top : 20,
        left: 20,
        right: 20,
        bottom:20
    };
    //-----------------------------------------------------------------------------------------------------------------------
    if(tfile==undefined){
        text = File("/C/Users/Administrator/Desktop/title.txt");
        text.open("r");
        titlefile="";
        titlefile+=text.read();
    }
    else {
        titlefile=tfile;
    }
    if(afile==undefined){
        text = File("/C/Users/Administrator/Desktop/author.txt");
        text.open("r");
        authorfile="";
        authorfile+=text.read();
    }
    else {
        authorfile=afile;
    }

    if(sfile==undefined){
        text = File("/C/Users/Administrator/Desktop/summary.txt");
        text.open("r");
        summaryfile="";
        summaryfile+=text.read();
    }
    else {
        summaryfile=sfile;
    }

    if(cfile==undefined){
        text = File("/C/Users/Administrator/Desktop/content.txt");
        text.open("r");
        contentfile="";
        contentfile+=text.read();
    }else {
        text = File(cfile);
        text.open("r");
        contentfile="";
        contentfile+=text.read();
    }

    if(p1==undefined)
        picture1 = File ("/C/Users/Administrator/Desktop/ttt.png");
    else picture1 = File (p1);
    picture1.open=("r");

    if(p2==undefined)
        picture2 = File ("/C/Users/Administrator/Desktop/ttt.png");
    else picture2 = File (p2);
    picture2.open=("r");

    if(p3==undefined)
        picture3= File ("/C/Users/Administrator/Desktop/ttt.png");
    else picture3 = File (p3);
    picture3.open=("r");

    color2=makeColor(myDocument,AllColor[col_index++], ColorSpace.RGB, ColorModel.process, [R[R_num],G[G_num],B[B_num]]);
    R_num+=9;G_num+=9;B_num+=9;
    //-----------------------------------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------------------------------
    page_line = myDocument.graphicLines.add();
    page_line.strokeWeight = 0.5;
    page_line.paths.item(0).pathPoints.item(0).anchor = [161, 278];
    page_line.paths.item(0).pathPoints.item(1).anchor = [161+29, 278];
    var page_num=firstpage.name;
    var page_footnote = firstpage.textFrames.add();
    page_footnote.geometricBounds = [280, 20, 280+7.5,20+170];
    page_footnote.contents =page_num+"    | "+titlefile;
    page_footnote.parentStory.paragraphs.item(0).pointSize = 8;
    page_footnote.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    page_footnote.parentStory.paragraphs.item(0).fontStyle = "Light"
    page_footnote.parentStory.paragraphs.item(0).justification=Justification.RIGHT_ALIGN;


    Line1 = firstpage.graphicLines.add();
    Line1.strokeWeight = 2;
    Line1.paths.item(0).pathPoints.item(0).anchor = [25, 25];
    Line1.paths.item(0).pathPoints.item(1).anchor = [25+170,25];

    var title = firstpage.textFrames.add();
    title.geometricBounds = [73.503, 20,73.503 +38.225  ,20+107.647];
    title.contents =titlefile;
    title.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    title.parentStory.paragraphs.item(0).justification=Justification.CENTER_ALIGN;
    title.parentStory.paragraphs.item(0).pointSize=40;
    for(i=0;i<title.characters.length;i++){
        title.characters[i].fillColor = color2;
    }

    var author = firstpage.textFrames.add();
    author.geometricBounds = [115.459 , 20.363,115.459 +6.168, 20.363+74.564];
    author.contents ="Photo & Text:\n"+authorfile;
    author.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    author.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    author.parentStory.paragraphs.item(0).pointSize=8;

    var quotation1 = firstpage.rectangles.add({geometricBounds:[141 ,20.363, 141+7.975 , 20.363+2.818]});
    quotation1.strokeWeight  = '0 pt'
    quotation1.place(File ("/C/Users/Administrator/Desktop/comma.png"),false);

    var quotation2 = firstpage.rectangles.add({geometricBounds:[141 ,23.5, 141+7.975, 23.5+2.818]});
    quotation2.strokeWeight  = '0 pt'
    quotation2.place(File ("/C/Users/Administrator/Desktop/comma.png"),false);

    var summary = firstpage.textFrames.add();
    summary.geometricBounds = [156, 20.5,156+22, 20.5+107.5];
    summary.contents =summaryfile;
    summary.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    summary.parentStory.paragraphs.item(0).fontStyle = "Light"
    summary.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    summary.parentStory.paragraphs.item(0).leading=14;
    summary.parentStory.paragraphs.item(0).pointSize =11;


    var text="";
    var times=0;
    for(var i=0;i<1000;i++){
        bold[i]=-1;
    }
    for(var i=0;i<contentfile.length;){
        if(i+3<contentfile.length&&contentfile[i]=="$"&&contentfile[i+1]=="s"&&contentfile[i+2]=="t"&&contentfile[i+3]=="$"){
            times++;
            i+=4;
            bold[index_content++]=i-4*times;
            while(!(contentfile[i]=="$"&&contentfile[i+1]=="/"&&contentfile[i+2]=="s"&&contentfile[i+3]=="$")||i>=contentfile.length){
                text+=contentfile[i];
                i++;
            }
            bold[index_content++]=i-4*times;
            times++;
            i+=4;
        }
        else{
            text+=contentfile[i];
            i++;
        }
    }
    var content = firstpage.textFrames.add();
    content.geometricBounds = [188.356,20,188.356+76.644,20+164.782];
    content.contents =text;
    content.parentStory.paragraphs.item(0).leading=14;
    content.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    content.parentStory.paragraphs.item(0).fontStyle = "Light"
    content.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    content.parentStory.paragraphs.item(0).pointSize =8;
    content.parentStory.paragraphs.item(0).dropCapCharacters =1;
    content.parentStory.paragraphs.item(0).dropCapLines =3;
    content.textFramePreferences.textColumnCount=2;
    content.textFramePreferences.verticalBalanceColumns=true;
    var first_time_add=true;
    for(;begin<index_content;begin+=2){
        if(bold[begin+1]-1<=content.contents.length){
            content.characters.itemByRange(bold[begin], bold[begin+1]-1).appliedFont = app.fonts.itemByName("intel Clear Hans");
            content.characters.itemByRange(bold[begin], bold[begin+1]-1).fontStyle = "Bold"
        }
        else{break;}
    }
    //-----------------------------------------------------------------------------------------------------------------------
    if(p1!=undefined){
        var image1 = firstpage.rectangles.add({geometricBounds:[188.356 ,20.499, 188.356+76.621 , 20.499+108.116]});
        image1.strokeWeight  = '0 pt'
        image1.place(picture1,false);
        image1.textWrapPreferences.textWrapMode = TextWrapModes.BOUNDING_BOX_TEXT_WRAP;
        image1.textWrapPreferences.textWrapOffset = [5,5,5,5];
    }
    if(p2!=undefined){
        var image2 = firstpage.rectangles.add({geometricBounds:[31.514 ,134.18, 31.514+70.89 , 134.18+76.45]});
        image2.strokeWeight  = '0 pt'
        image2.place(picture2,false);
        image2.textWrapPreferences.textWrapMode = TextWrapModes.BOUNDING_BOX_TEXT_WRAP;
    }
    if(p3!=undefined){
        var image3 = firstpage.rectangles.add({geometricBounds:[107  ,134.18, 107 +70.89 , 134.18+76.45]});
        image3.strokeWeight  = '0 pt'
        image3.place(picture3,false);
        image3.textWrapPreferences.textWrapMode = TextWrapModes.BOUNDING_BOX_TEXT_WRAP;
    }
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function model4(myDocument,tfile,afile,cfile,R,G,B,p1){//1140
    with(myDocument.documentPreferences){
        pageHeight = "297mm";
        pageWidth = "210mm";
        pageOrientation = PageOrientation.portrait;
        pagesPerDocument = 1;
    }
    var firstpage = myDocument.pages.item(0);
    firstpage.marginPreferences.properties = {
        top : 20,
        left: 20,
        right: 20,
        bottom:20
    };
    //-----------------------------------------------------------------------------------------------------------------------
    if(tfile==undefined){
        text = File("/C/Users/Administrator/Desktop/title.txt");
        text.open("r");
        titlefile="";
        titlefile+=text.read();
    }
    else {
        titlefile=tfile;
    }
    if(afile==undefined){
        text = File("/C/Users/Administrator/Desktop/author.txt");
        text.open("r");
        authorfile="";
        authorfile+=text.read();
    }
    else {
        authorfile=afile;
    }
    if(cfile==undefined){
        text = File("/C/Users/Administrator/Desktop/content.txt");
        text.open("r");
        contentfile="";
        contentfile+=text.read();
    }else {
        text = File(cfile);
        text.open("r");
        contentfile="";
        contentfile+=text.read();
    }

    if(p1==undefined)
        picture1 = File ("/C/Users/Administrator/Desktop/ttt.png");
    else picture1 = File (p1);
    picture1.open=("r");
    color=makeColor(myDocument,AllColor[col_index++], ColorSpace.RGB, ColorModel.process, [R[R_num],G[G_num],B[B_num]]);
    R_num+=3;G_num+=3;B_num+=3;
    //-----------------------------------------------------------------------------------------------------------------------
    green = makeColor(myDocument,"green", ColorSpace.RGB, ColorModel.process, [152,210,198]);
    bg = color;
    //-----------------------------------------------------------------------------------------------------------------------
    page_line = myDocument.graphicLines.add();
    page_line.strokeWeight = 0.5;
    page_line.paths.item(0).pathPoints.item(0).anchor = [161, 278];
    page_line.paths.item(0).pathPoints.item(1).anchor = [161+29, 278];
    var page_num=firstpage.name;
    var page_footnote = firstpage.textFrames.add();
    page_footnote.geometricBounds = [280, 20, 280+7.5,20+170];
    page_footnote.contents =page_num+"    | "+titlefile;
    page_footnote.parentStory.paragraphs.item(0).pointSize = 8;
    page_footnote.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    page_footnote.parentStory.paragraphs.item(0).fontStyle = "Light"
    page_footnote.parentStory.paragraphs.item(0).justification=Justification.RIGHT_ALIGN;


    var DLartist = firstpage.textFrames.add();
    DLartist.geometricBounds = [68.904 , 65.709 ,68.904+4.096,65.709+57.5];
    DLartist.contents="//DLArtist//";
    DLartist.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    DLartist.parentStory.paragraphs.item(0).fontStyle = "Light"
    DLartist.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    DLartist.parentStory.paragraphs.item(0).pointSize=9;

    var title = firstpage.textFrames.add();
    title.geometricBounds = [78.451 , 65.709 ,78.451 +8.158, 65.709+48.77 ];
    title.contents =titlefile;
    title.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    title.parentStory.paragraphs.item(0).fontStyle = "Regular"
    title.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    title.parentStory.paragraphs.item(0).pointSize=14;

    Line1 = myDocument.graphicLines.add();
    Line1.strokeWeight = 0.5;
    Line1.paths.item(0).pathPoints.item(0).anchor = [0, 82.656];
    Line1.paths.item(0).pathPoints.item(1).anchor = [56.419 , 82.656];


    var text="";
    var times=0;
    for(var i=0;i<1000;i++){
        bold[i]=-1;
    }
    for(var i=0;i<contentfile.length-3;){
        if(contentfile[i]=="$"&&contentfile[i+1]=="s"&&contentfile[i+2]=="t"&&contentfile[i+3]=="$"){
            times++; i+=4;
            bold[index_content++]=i-4*times;
            while(!(contentfile[i]=="$"&&contentfile[i+1]=="/"&&contentfile[i+2]=="s"&&contentfile[i+3]=="$")){
                text+=contentfile[i];
                i++;
            }
            bold[index_content++]=i-4*times;
            times++; i+=4;
        }
        else{
            text+=contentfile[i];
            i++;
        }
    }
    var content = firstpage.textFrames.add();
    content.geometricBounds = [96.175 , 65.709,96.175 +180.825, 65.709+57.5 ];
    var content2 = firstpage.textFrames.add();
    content2.geometricBounds = [96.175 , 132.5,96.175 +180.825, 132.5+57.5 ];
    content2.previousTextFrame = content;
    content.contents =text;
    content.parentStory.paragraphs.item(0).leading=14;
    content.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    content.parentStory.paragraphs.item(0).fontStyle = "Light"
    content.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    content.parentStory.paragraphs.item(0).pointSize =8;
    var first_time_add=true;
    var second_time_add=true;
    for(;begin<index_content;begin+=2){
        if(bold[begin+1]-1<=content.contents.length){
            content.characters.itemByRange(bold[begin], bold[begin+1]-1).appliedFont = app.fonts.itemByName("intel Clear Hans");
            content.characters.itemByRange(bold[begin], bold[begin+1]-1).fontStyle = "Bold"
        }
        else if(bold[begin+1]-1<=content.contents.length+content2.contents.length){
            if(first_time_add){
                first_time_add=false;
                offset+=content.contents.length;
            }
            content2.characters.itemByRange(bold[begin]-offset, bold[begin+1]-1-offset).appliedFont = app.fonts.itemByName("intel Clear Hans");
            content2.characters.itemByRange(bold[begin]-offset, bold[begin+1]-1-offset).fontStyle = "Bold"
        }
    }
    offset+=content2.contents.length;
    //-----------------------------------------------------------------------------------------------------------------------
    if(p1!=undefined){
        var image1 = firstpage.rectangles.add({geometricBounds:[152, 0, 152+106.681, 123.209]});
        image1.strokeWeight  = '0 pt'
        image1.place(picture1,false);
        image1.textWrapPreferences.textWrapMode = TextWrapModes.BOUNDING_BOX_TEXT_WRAP;
        image1.textWrapPreferences.textWrapOffset = [0,0,0,0];
    }

}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function model5(myDocument,tfile,afile,sfile,cfile,R,G,B,p1){//1140
    with(myDocument.documentPreferences){
        pageHeight = "297mm";
        pageWidth = "210mm";
        pageOrientation = PageOrientation.portrait;
        pagesPerDocument = 1;
    }
    var firstpage = myDocument.pages.item(0);
    firstpage.marginPreferences.properties = {
        top : 20,
        left: 20,
        right: 20,
        bottom:20
    };
    //-----------------------------------------------------------------------------------------------------------------------
    if(tfile==undefined){
        text = File("/C/Users/Administrator/Desktop/title.txt");
        text.open("r");
        titlefile="";
        titlefile+=text.read();
    }else titlefile=tfile;

    if(afile==undefined){
        text = File("/C/Users/Administrator/Desktop/author.txt");
        text.open("r");
        authorfile="";
        authorfile+=text.read();
    }else authorfile=afile;

    if(sfile==undefined){
        text = File("/C/Users/Administrator/Desktop/summary.txt");
        text.open("r");
        summaryfile="";
        summaryfile+=text.read();
    }
    else {
        summaryfile=sfile;
    }

    if(cfile==undefined){
        text = File("/C/Users/Administrator/Desktop/content.txt");
        text.open("r");
        contentfile="";
        contentfile+=text.read();
    }else {
        text = File(cfile);
        text.open("r");
        contentfile="";
        contentfile+=text.read();
    }

    if(p1==undefined)
        picture1 = File ("/C/Users/Administrator/Desktop/ttt.png");
    else picture1 = File (p1);
    picture1.open=("r");
    color1=makeColor(myDocument,AllColor[col_index++], ColorSpace.RGB, ColorModel.process, [R[R_num],G[G_num],B[B_num]]);
    color2=makeColor(myDocument,AllColor[col_index++], ColorSpace.RGB, ColorModel.process, [R[R_num+=2],G[G_num+=2],B[B_num+=2]]);
    //-----------------------------------------------------------------------------------------------------------------------
    black = makeColor(myDocument,"black", ColorSpace.RGB, ColorModel.process, [0,0,0]);
    white = makeColor(myDocument,"white", ColorSpace.RGB, ColorModel.process, [255,255,255]);
    bg = color1;
    bg2=color2;
    //-----------------------------------------------------------------------------------------------------------------------
    page_line = myDocument.graphicLines.add();
    page_line.strokeWeight = 0.5;
    page_line.paths.item(0).pathPoints.item(0).anchor = [161, 278];
    page_line.paths.item(0).pathPoints.item(1).anchor = [161+29, 278];
    var page_num=firstpage.name;
    var page_footnote = firstpage.textFrames.add();
    page_footnote.geometricBounds = [280, 20, 280+7.5,20+170];
    page_footnote.contents =page_num+"    | "+titlefile;
    page_footnote.parentStory.paragraphs.item(0).pointSize = 8;
    page_footnote.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    page_footnote.parentStory.paragraphs.item(0).fontStyle = "Light"
    page_footnote.parentStory.paragraphs.item(0).justification=Justification.RIGHT_ALIGN;


    var title = firstpage.textFrames.add();
    title.geometricBounds = [37.95 , 35 ,37.95 +16.668 , 35 +135.48];
    title.contents =titlefile;
    title.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    title.parentStory.paragraphs.item(0).fontStyle = "Regular"
    title.parentStory.paragraphs.item(0).justification=Justification.CENTER_ALIGN;
    title.parentStory.paragraphs.item(0).pointSize=28;

    Line1 = myDocument.graphicLines.add();
    Line1.strokeWeight = 2.835;
    Line1.paths.item(0).pathPoints.item(0).anchor = [89.332,53.466];
    Line1.paths.item(0).pathPoints.item(1).anchor = [31.74+89.332,53.466];
    Line1.strokeColor=bg;

    Line2 = myDocument.graphicLines.add();
    Line2.strokeWeight = 0.709;
    Line2.paths.item(0).pathPoints.item(0).anchor = [24.5,54.694];
    Line2.paths.item(0).pathPoints.item(1).anchor = [24.5+161.404  ,54.694 ];
    Line2.strokeColor=bg;

    Line3 = myDocument.graphicLines.add();
    Line3.strokeWeight =0.709;
    Line3.paths.item(0).pathPoints.item(0).anchor = [105.077,94.432];
    Line3.paths.item(0).pathPoints.item(1).anchor = [105.077, 277];

    var summary = firstpage.textFrames.add();
    summary.geometricBounds = [67.508 , 24.5, 67.508 +14.744 ,24.5+161.404 ];
    summary.contents =summaryfile;
    summary.parentStory.paragraphs.item(0).dropCapCharacters =1;
    summary.parentStory.paragraphs.item(0).dropCapLines =2;
    summary.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    summary.parentStory.paragraphs.item(0).justification=Justification.CENTER_ALIGN;
    summary.parentStory.paragraphs.item(0).leading=12;
    summary.parentStory.paragraphs.item(0).pointSize = 9;

    var text="";
    var times=0;
    for(var i=0;i<1000;i++){
        bold[i]=-1;
    }
    for(var i=0;i<contentfile.length-3;){
        if(contentfile[i]=="$"&&contentfile[i+1]=="s"&&contentfile[i+2]=="t"&&contentfile[i+3]=="$"){
            times++; i+=4;
            bold[index_content++]=i-4*times;
            while(!(contentfile[i]=="$"&&contentfile[i+1]=="/"&&contentfile[i+2]=="s"&&contentfile[i+3]=="$")){
                text+=contentfile[i];
                i++;
            }
            bold[index_content++]=i-4*times;
            times++; i+=4;
        }
        else{
            text+=contentfile[i];
            i++;
        }
    }
    var content = firstpage.textFrames.add();
    content.geometricBounds = [94.432 , 24.5 ,94.432 +182.568, 24.5 +77.988 ];
    var content2 = firstpage.textFrames.add();
    content2.geometricBounds = [94.432, 107.916 ,94.432+182.568, 107.916 +77.988];
    content2.previousTextFrame = content;
    content.contents =text;
    content.parentStory.paragraphs.item(0).leading=14;
    content.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    content.parentStory.paragraphs.item(0).fontStyle = "Light"
    content.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    content.parentStory.paragraphs.item(0).pointSize =8;
    var first_time_add=true;
    for(;begin<index_content;begin+=2){
        if(bold[begin+1]-1<=content.contents.length){
            content.characters.itemByRange(bold[begin], bold[begin+1]-1).appliedFont = app.fonts.itemByName("intel Clear Hans");
            content.characters.itemByRange(bold[begin], bold[begin+1]-1).fontStyle = "Bold"
        }
        else if(bold[begin+1]-1<=content.contents.length+content2.contents.length){
            if(first_time_add){
                first_time_add=false;
                offset+=content.contents.length;
            }
            content2.characters.itemByRange(bold[begin]-offset, bold[begin+1]-1-offset).appliedFont = app.fonts.itemByName("intel Clear Hans");
            content2.characters.itemByRange(bold[begin]-offset, bold[begin+1]-1-offset).fontStyle = "Bold"
        }
    }
    offset+=content2.contents.length;
    //-----------------------------------------------------------------------------------------------------------------------
    if(p1!=undefined){
        var image1 = firstpage.rectangles.add({geometricBounds:[130.999, 107.916, 130.999+85.527 , 107.916+77.988]});
        image1.strokeWeight  = '5.669 pt'
        image1.strokeColor=bg2;
        image1.place(picture1,false);
        image1.textWrapPreferences.textWrapMode = TextWrapModes.BOUNDING_BOX_TEXT_WRAP;
        image1.textWrapPreferences.textWrapOffset = [5,5,5,5];
    }
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function model6(myDocument,R,G,B,picture1,picture2,f1,f2){//can't be the last page!
    doc = myDocument
    newPage = doc.pages.add();
    newPage.marginPreferences.properties = {
        top : 20,
        left: 20,
        right: 20,
        bottom:20
    };
    oldRuler = doc.viewPreferences.rulerOrigin
    doc.viewPreferences.rulerOrigin = RulerOrigin.pageOrigin;
    //-----------------------------------------------------------------------------------------------------------------------
    if(picture1==undefined)
        picture1 = File ("/C/Users/Administrator/Desktop/ttt.png");
    else picture1 = File (picture1);
    picture1.open=("r");

    if(picture2==undefined)
        picture2 = File ("/C/Users/Administrator/Desktop/ttt.png");
    else picture2 = File (picture2);
    picture1.open=("r");
    //-----------------------------------------------------------------------------------------------------------------------
    color_origin=makeColor(myDocument,AllColor[col_index++], ColorSpace.RGB, ColorModel.process, [R[R_num],G[G_num],B[B_num]]);
    color_reverse=makeColor(myDocument,AllColor[col_index++], ColorSpace.RGB, ColorModel.process, [255-R[R_num],255-G[G_num],255-B[B_num]]);

    var page_num=newPage.name;
    if(page_num%2==0){
        page_line = newPage.graphicLines.add();
        page_line.strokeWeight = 0.5;
        page_line.paths.item(0).pathPoints.item(0).anchor = [20, 278];
        page_line.paths.item(0).pathPoints.item(1).anchor = [20+29, 278];
        var page_footnote = newPage.textFrames.add();
        page_footnote.geometricBounds = [280, 20, 280+7.5,20+170];
        page_footnote.contents =page_num+"    | "+titlefile;
        page_footnote.parentStory.paragraphs.item(0).pointSize = 8;
        page_footnote.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
        page_footnote.parentStory.paragraphs.item(0).fontStyle = "Light"
        page_footnote.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    }
    else{
        page_line = newPage.graphicLines.add();
        page_line.strokeWeight = 0.5;
        page_line.paths.item(0).pathPoints.item(0).anchor = [161, 278];
        page_line.paths.item(0).pathPoints.item(1).anchor = [161+29, 278];
        var page_footnote = newPage.textFrames.add();
        page_footnote.geometricBounds = [280, 20, 280+7.5,20+170];
        page_footnote.contents =page_num+"    | "+titlefile;
        page_footnote.parentStory.paragraphs.item(0).pointSize = 8;
        page_footnote.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
        page_footnote.parentStory.paragraphs.item(0).fontStyle = "Light"
        page_footnote.parentStory.paragraphs.item(0).justification=Justification.RIGHT_ALIGN;
    }

    decoration = newPage.graphicLines.add();
    decoration.strokeWeight =2;
    decoration.paths.item(0).pathPoints.item(0).anchor = [25,20];
    decoration.paths.item(0).pathPoints.item(1).anchor = [25+160 , 20];

    var content_fellow = newPage.textFrames.add();
    content_fellow.geometricBounds = [25, 20,25+252,20+170];
    content_fellow.previousTextFrame = doc.pages[-2].textFrames[0];
    content_fellow.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    content_fellow.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    content_fellow.parentStory.paragraphs.item(0).pointSize =8;
    content_fellow.parentStory.paragraphs.item(0).leading=14;
    content_fellow.textFramePreferences.textColumnCount=2;
    content_fellow.textFramePreferences.verticalBalanceColumns=true;
    //-----------------------------------------------------------------------------------------------------------------------
    if(f1){
        R_num+=3;G_num+=3;B_num+=3;
        var image1 = newPage.rectangles.add({geometricBounds:[25,75.466,25+139.73 ,75.466+114.534]});
        image1.strokeWeight  = '0 pt'
        image1.place(picture1,false);
        image1.textWrapPreferences.textWrapMode = TextWrapModes.BOUNDING_BOX_TEXT_WRAP;
        image1.textWrapPreferences.textWrapOffset = [3,3,3,3];
    }
    if(f2){
        R_num+=3;G_num+=3;B_num+=3;
        var image2 = newPage.rectangles.add({geometricBounds:[169.464,75.466,169.464+107.389, 75.466+114.534]});
        image2.strokeWeight  = '0 pt'
        image2.place(picture2,false);
        image2.textWrapPreferences.textWrapMode = TextWrapModes.BOUNDING_BOX_TEXT_WRAP;
        image2.textWrapPreferences.textWrapOffset = [3,3,0,3];
    }
    //-----------------------------------------------------------------------------------------------------------------------
    doc.viewPreferences.rulerOrigin = oldRuler;
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function model7(myDocument,picture1,f1){//can be the last page.
    doc = myDocument
    newPage = doc.pages.add();
    newPage.marginPreferences.properties = {
        top : 20,
        left: 20,
        right: 20,
        bottom:20
    };
    oldRuler = doc.viewPreferences.rulerOrigin
    doc.viewPreferences.rulerOrigin = RulerOrigin.pageOrigin;
    //-----------------------------------------------------------------------------------------------------------------------
    if(picture1==undefined)
        picture1 = File ("/C/Users/Administrator/Desktop/ttt.png");
    else picture1 = File (picture1);
    picture1.open=("r");
    //-----------------------------------------------------------------------------------------------------------------------
    var page_num=newPage.name;
    if(page_num%2==0){
        page_line = newPage.graphicLines.add();
        page_line.strokeWeight = 0.5;
        page_line.paths.item(0).pathPoints.item(0).anchor = [20, 278];
        page_line.paths.item(0).pathPoints.item(1).anchor = [20+29, 278];
        var page_footnote = newPage.textFrames.add();
        page_footnote.geometricBounds = [280, 20, 280+7.5,20+170];
        page_footnote.contents =page_num+"    | "+titlefile;
        page_footnote.parentStory.paragraphs.item(0).pointSize = 8;
        page_footnote.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
        page_footnote.parentStory.paragraphs.item(0).fontStyle = "Light"
        page_footnote.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    }
    else{
        page_line = newPage.graphicLines.add();
        page_line.strokeWeight = 0.5;
        page_line.paths.item(0).pathPoints.item(0).anchor = [161, 278];
        page_line.paths.item(0).pathPoints.item(1).anchor = [161+29, 278];
        var page_footnote = newPage.textFrames.add();
        page_footnote.geometricBounds = [280, 20, 280+7.5,20+170];
        page_footnote.contents =page_num+"    | "+titlefile;
        page_footnote.parentStory.paragraphs.item(0).pointSize = 8;
        page_footnote.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
        page_footnote.parentStory.paragraphs.item(0).fontStyle = "Light"
        page_footnote.parentStory.paragraphs.item(0).justification=Justification.RIGHT_ALIGN;
    }


    decoration = newPage.graphicLines.add();
    decoration.strokeWeight =2;
    decoration.paths.item(0).pathPoints.item(0).anchor = [25,20];
    decoration.paths.item(0).pathPoints.item(1).anchor = [25+160 , 20];

    var content_fellow = newPage.textFrames.add();
    content_fellow.geometricBounds = [25,20,25+252,20+170];
    content_fellow.previousTextFrame = doc.pages[-2].textFrames[0];
    content_fellow.parentStory.paragraphs.item(0).leading=14;
    content_fellow.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    content_fellow.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    content_fellow.parentStory.paragraphs.item(0).pointSize =8;
    content_fellow.textFramePreferences.textColumnCount=2;
    //-----------------------------------------------------------------------------------------------------------------------
    if(f1){
        R_num+=3;G_num+=3;B_num+=3;
        var placeHolder1 = newPage.rectangles.add({geometricBounds:[20, 87.32, 20+48.5, 87.32+122.68]});
        placeHolder1.strokeWeight  = '0 pt'
        placeHolder1.textWrapPreferences.textWrapMode = TextWrapModes.BOUNDING_BOX_TEXT_WRAP;
    }
    if(f1){
        var image2= newPage.rectangles.add({geometricBounds:[48, 137.512 ,48+68.7, 137.512+69.2]});
        image2.strokeWeight  = '0 pt'
        image2.absoluteRotationAngle=-16.5;
        image2.place(picture1,false);
        image2.textWrapPreferences.textWrapMode = TextWrapModes.BOUNDING_BOX_TEXT_WRAP;
        image2.textWrapPreferences.textWrapOffset = [2,2,2,2];

        var image1 = newPage.rectangles.add({geometricBounds:[38,79.312,38+71.263, 79.312+66.452]});
        image1.strokeWeight  = '0 pt'
        image1.absoluteRotationAngle=15;
        image1.place(picture1,false);
        image1.textWrapPreferences.textWrapMode = TextWrapModes.BOUNDING_BOX_TEXT_WRAP;
        image1.textWrapPreferences.textWrapOffset = [2,2,2,2];
    }
    //-----------------------------------------------------------------------------------------------------------------------
    doc.viewPreferences.rulerOrigin = oldRuler;
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function model8(myDocument,R,G,B,picture1,picture2,f1,f2){
    doc = myDocument
    newPage = doc.pages.add();
    newPage.marginPreferences.properties = {
        top : 20,
        left: 20,
        right: 20,
        bottom:20
    };
    oldRuler = doc.viewPreferences.rulerOrigin
    doc.viewPreferences.rulerOrigin = RulerOrigin.pageOrigin;
    //-----------------------------------------------------------------------------------------------------------------------
    if(picture1==undefined)
        picture1 = File ("/C/Users/Administrator/Desktop/ttt.png");
    else picture1=File(picture1);
    picture1.open=("r");
    if(picture2==undefined)
        picture2 = File ("/C/Users/Administrator/Desktop/ttt.png");
    else picture2=File(picture2);
    picture2.open=("r");
    //-----------------------------------------------------------------------------------------------------------------------
    color_origin=makeColor(myDocument,AllColor[col_index++], ColorSpace.RGB, ColorModel.process, [R[R_num],G[G_num],B[B_num]]);
    color_reverse=makeColor(myDocument,AllColor[col_index++], ColorSpace.RGB, ColorModel.process, [255-R[R_num],255-G[G_num],255-B[B_num]]);

    var page_num=newPage.name;
    if(page_num%2==0){
        page_line = newPage.graphicLines.add();
        page_line.strokeWeight = 0.5;
        page_line.paths.item(0).pathPoints.item(0).anchor = [20, 278];
        page_line.paths.item(0).pathPoints.item(1).anchor = [20+29, 278];
        var page_footnote = newPage.textFrames.add();
        page_footnote.geometricBounds = [280, 20, 280+7.5,20+170];
        page_footnote.contents =page_num+"    | "+titlefile;
        page_footnote.parentStory.paragraphs.item(0).pointSize = 8;
        page_footnote.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
        page_footnote.parentStory.paragraphs.item(0).fontStyle = "Light"
        page_footnote.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    }
    else{
        page_line = newPage.graphicLines.add();
        page_line.strokeWeight = 0.5;
        page_line.paths.item(0).pathPoints.item(0).anchor = [161, 278];
        page_line.paths.item(0).pathPoints.item(1).anchor = [161+29, 278];
        var page_footnote = newPage.textFrames.add();
        page_footnote.geometricBounds = [280, 20, 280+7.5,20+170];
        page_footnote.contents =page_num+"    | "+titlefile;
        page_footnote.parentStory.paragraphs.item(0).pointSize = 8;
        page_footnote.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
        page_footnote.parentStory.paragraphs.item(0).fontStyle = "Light"
        page_footnote.parentStory.paragraphs.item(0).justification=Justification.RIGHT_ALIGN;
    }

    if(f1){
        R_num+=3;G_num+=3;B_num+=3;
        var colorsquare=newPage.rectangles.add({geometricBounds:[25, 20 ,25+141.857,20+170]});
        colorsquare.fillColor=color_origin;
        colorsquare.strokeWeight  = '0 pt'
    }

    decoration = newPage.graphicLines.add();
    decoration.strokeWeight =2;
    decoration.paths.item(0).pathPoints.item(0).anchor = [25,20];
    decoration.paths.item(0).pathPoints.item(1).anchor = [25+160 , 20];

    var content_fellow = newPage.textFrames.add();
    content_fellow.geometricBounds = [32,20 ,32 +134.857 ,20 +170];
    content_fellow.previousTextFrame = doc.pages[-2].textFrames[0];
    content_fellow.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    content_fellow.parentStory.paragraphs.item(0).fontStyle = "Light"
    content_fellow.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    content_fellow.parentStory.paragraphs.item(0).pointSize =8;
    content_fellow.parentStory.paragraphs.item(0).leading=14;
    content_fellow.textFramePreferences.textColumnCount=2;
    content_fellow.textFramePreferences.verticalBalanceColumns=true;

    var content_fellow1=newPage.textFrames.add();
    content_fellow1.geometricBounds=[171.857, 20 ,171.857 +105.143 ,20 +170];
    content_fellow1.previousTextFrame = content_fellow;
    content_fellow1.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    content_fellow1.parentStory.paragraphs.item(0).fontStyle = "Light"
    content_fellow1.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    content_fellow1.parentStory.paragraphs.item(0).pointSize =8;
    content_fellow1.parentStory.paragraphs.item(0).leading=14;
    content_fellow1.textFramePreferences.textColumnCount=2;
    content_fellow1.textFramePreferences.verticalBalanceColumns=true;
    //-----------------------------------------------------------------------------------------------------------------------
    if(f1){
        var image1 = newPage.rectangles.add({geometricBounds:[32, 25 ,32+128, 25+77.5]});
        image1.strokeWeight  = '0 pt'
        image1.place(picture1,false);
        image1.textWrapPreferences.textWrapMode = TextWrapModes.BOUNDING_BOX_TEXT_WRAP;
        image1.textWrapPreferences.textWrapOffset = [5,5,5,5];
        content_fellow.texts.everyItem().fillColor = color_reverse;
    }
    if(f2){
        R_num+=3;G_num+=3;B_num+=3;
        var image2 = newPage.rectangles.add({geometricBounds:[171.857, 106.5 ,171.857+102.143,106.5+83.5]});
        image2.strokeWeight  = '0 pt'
        image2.place(picture2,false);
        image2.textWrapPreferences.textWrapMode = TextWrapModes.BOUNDING_BOX_TEXT_WRAP;
        image2.textWrapPreferences.textWrapOffset = [5,5,3,5];
    }
    doc.viewPreferences.rulerOrigin = oldRuler;

}

function model9(myDocument,R,G,B,picture1,picture2,f1,f2){//can be the last page
    doc = myDocument
    newPage = doc.pages.add();
    newPage.marginPreferences.properties = {
        top : 20,
        left: 20,
        right: 20,
        bottom:20
    };
    oldRuler = doc.viewPreferences.rulerOrigin
    doc.viewPreferences.rulerOrigin = RulerOrigin.pageOrigin;
    //-----------------------------------------------------------------------------------------------------------------------
    if(picture1==undefined)
        picture1 = File ("/C/Users/Administrator/Desktop/ttt.png");
    else picture1 = File (picture1);
    picture1.open=("r");
    if(picture2==undefined)
        picture2 = picture1;
    else picture2 = File (picture2);
    picture2.open=("r");
    //-----------------------------------------------------------------------------------------------------------------------
    color_origin=makeColor(myDocument,AllColor[col_index++], ColorSpace.RGB, ColorModel.process, [R[R_num],G[G_num],B[B_num]]);
    color_reverse=makeColor(myDocument,AllColor[col_index++], ColorSpace.RGB, ColorModel.process, [255-R[R_num],255-G[G_num],255-B[B_num]]);

    var page_num=newPage.name;
    if(page_num%2==0){
        page_line = newPage.graphicLines.add();
        page_line.strokeWeight = 0.5;
        page_line.paths.item(0).pathPoints.item(0).anchor = [20, 278];
        page_line.paths.item(0).pathPoints.item(1).anchor = [20+29, 278];
        var page_footnote = newPage.textFrames.add();
        page_footnote.geometricBounds = [280, 20, 280+7.5,20+170];
        page_footnote.contents =page_num+"    | "+titlefile;
        page_footnote.parentStory.paragraphs.item(0).pointSize = 8;
        page_footnote.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
        page_footnote.parentStory.paragraphs.item(0).fontStyle = "Light"
        page_footnote.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    }
    else{
        page_line = newPage.graphicLines.add();
        page_line.strokeWeight = 0.5;
        page_line.paths.item(0).pathPoints.item(0).anchor = [161, 278];
        page_line.paths.item(0).pathPoints.item(1).anchor = [161+29, 278];
        var page_footnote = newPage.textFrames.add();
        page_footnote.geometricBounds = [280, 20, 280+7.5,20+170];
        page_footnote.contents =page_num+"    | "+titlefile;
        page_footnote.parentStory.paragraphs.item(0).pointSize = 8;
        page_footnote.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
        page_footnote.parentStory.paragraphs.item(0).fontStyle = "Light"
        page_footnote.parentStory.paragraphs.item(0).justification=Justification.RIGHT_ALIGN;
    }

    if(f2){
        var colorsquare=newPage.rectangles.add({geometricBounds:[25, 104.5 ,25+252 ,104.5+87.5]});
        colorsquare.fillColor=color_origin;
        colorsquare.strokeWeight  = '0 pt'
    }
    decoration = newPage.graphicLines.add();
    decoration.strokeWeight =2;
    decoration.paths.item(0).pathPoints.item(0).anchor = [25,20];
    decoration.paths.item(0).pathPoints.item(1).anchor = [25+160 , 20];


    var content_fellow = newPage.textFrames.add();
    content_fellow.geometricBounds = [25,20 ,25+252 ,20+78.5];
    content_fellow.previousTextFrame = doc.pages[-2].textFrames[0];
    content_fellow.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    content_fellow.parentStory.paragraphs.item(0).fontStyle = "Light"
    content_fellow.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    content_fellow.parentStory.paragraphs.item(0).pointSize =8;
    content_fellow.parentStory.paragraphs.item(0).leading=14;

    var content_fellow1=newPage.textFrames.add();
    content_fellow1.geometricBounds=[25,106.5 ,25+252,106.5+83.5];
    content_fellow1.previousTextFrame = content_fellow;
    content_fellow1.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("intel Clear Hans");
    content_fellow1.parentStory.paragraphs.item(0).fontStyle = "Light"
    content_fellow1.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    content_fellow1.parentStory.paragraphs.item(0).pointSize =8;
    content_fellow1.parentStory.paragraphs.item(0).leading=14;
    //-----------------------------------------------------------------------------------------------------------------------
    if(f1){
        R_num+=3;G_num+=3;B_num+=3;
        Line1 = newPage.graphicLines.add();
        Line1.strokeWeight = 6;
        Line1.paths.item(0).pathPoints.item(0).anchor = [20, 126 ];
        Line1.paths.item(0).pathPoints.item(1).anchor = [20+78.5 ,126];

        Line2 = newPage.graphicLines.add();
        Line2.strokeWeight = 6;
        Line2.paths.item(0).pathPoints.item(0).anchor = [20, 200.5 ];
        Line2.paths.item(0).pathPoints.item(1).anchor = [20+78.5,200.5];

        var image1 = newPage.rectangles.add({geometricBounds:[129.571, 20 ,129.571+68.429, 20+78.5]});
        image1.strokeWeight  = '0 pt'
        image1.place(picture1,false);
        image1.textWrapPreferences.textWrapMode = TextWrapModes.BOUNDING_BOX_TEXT_WRAP;
        image1.textWrapPreferences.textWrapOffset = [5,5,5,5];
    }
    if(f2){
        R_num+=3;G_num+=3;B_num+=3;
        var image2 = newPage.rectangles.add({geometricBounds:[25, 104 ,25+104.918, 104+88]});
        image2.strokeWeight  = '0 pt'
        image2.place(picture2,false);
        image2.textWrapPreferences.textWrapMode = TextWrapModes.BOUNDING_BOX_TEXT_WRAP;
        image2.textWrapPreferences.textWrapOffset = [5,5,5,5];
        content_fellow1.texts.everyItem().fillColor = color_reverse;
    }

    doc.viewPreferences.rulerOrigin = oldRuler;
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function makeColor(myDocument,colorName, colorSpace, colorModel, colorValue) {
    if(colorValue[0]===-1){
        r=218;
        g=218;
        b=218;
    }
    else if(colorValue[0]===256){
        r=255-218;
        g=255-218;
        b=255-218;
    }
    else {
        r=colorValue[0];
        g=colorValue[1];
        b=colorValue[2];
    }
    color = myDocument.colors.add({name: colorName, space:ColorSpace.RGB, model:ColorModel.process,colorValue:[r,g,b]});
    return color;
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function del(myDocument) {
    var doc =myDocument;
    var last_frame = doc.pages[-1].textFrames[0];
    var geo= doc.pages[-1].textFrames[0].geometricBounds;
    var now_height = geo[2]-geo[0];
    if(now_height<2){doc.pages[-1].remove();return true}
    return false;
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function fit(){
    app.documents[0].rectangles.everyItem().fit(FitOptions.CONTENT_TO_FRAME);
    app.documents[0].ovals.everyItem().fit(FitOptions.CONTENT_TO_FRAME);
    for(i=0;i<app.documents[0].textFrames.length;i++){
        if(app.documents[0].textFrames[i].contents=="Designed by DLarist"||app.documents[0].textFrames[i].contents=="Designed\nby\nDLarist")continue;
        app.documents[0].textFrames[i].fit(FitOptions.FRAME_TO_CONTENT);
    }
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function print(myDocument,file_path){
    myDocument = myDocument;
    var myFilePath = file_path;
    var myFile = new File(myFilePath);
    myDocument.exportFile(ExportFormat.pdfType, myFile, "Press Quality");
}
