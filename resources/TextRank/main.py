#-*- encoding:utf-8 -*-
# coding: utf-8
import sys
import logging
import jieba

jieba.setLogLevel(logging.INFO)

try:
    reload(sys)
    sys.setdefaultencoding('utf-8')
except:
    pass

import codecs
from textrank import  TextRank4Sentence

file = sys.argv[1]
try:
    text = codecs.open(file, 'r', 'gbk').read()
except BaseException:
    text = codecs.open(file, 'r', 'utf-8').read()

tr4s = TextRank4Sentence()
tr4s.analyze(text=text, lower=True, source = 'all_filters')

for item in tr4s.get_key_sentences(num=1):
    print(item.sentence)  