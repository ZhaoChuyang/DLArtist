#!/usr/bin/env python
# -*- coding: utf-8 -*-


import os
from io import BytesIO
from tempfile import NamedTemporaryFile
from argparse import ArgumentParser
from PIL import Image
from numpy import array
from scipy.cluster.vq import kmeans
from colorsys import rgb_to_hsv, hsv_to_rgb
from scipy.spatial.distance import pdist
from scipy.special import comb

# Python3 compatibility
try:
    from urllib2 import urlopen
except ImportError:
    from urllib.request import urlopen

DEFAULT_NUM_COLORS = 1
DEFAULT_MINV = 170
DEFAULT_MAXV = 200
DEFAULT_BOLD_ADD = 50
DEFAULT_FONT_SIZE = 1
DEFAULT_BG_COLOR = '#272727'

THUMB_SIZE = (200, 200)
SCALE = 256.0


def down_scale(x):
    return x / SCALE


def up_scale(x):
    return int(x * SCALE)


def hexify(rgb):
    return '#%s' % ''.join('%02x' % p for p in rgb)


def get_colors(img):
    """
    Returns a list of all the image's colors.
    """
    w, h = img.size
    return [color[:3] for count, color in img.convert('RGB').getcolors(w * h)]


def clamp(color, min_v, max_v):
    """
    Clamps a color such that the value is between min_v and max_v.
    """
    h, s, v = rgb_to_hsv(*map(down_scale, color))
    min_v, max_v = map(down_scale, (min_v, max_v))
    v = min(max(min_v, v), max_v)
    return tuple(map(up_scale, hsv_to_rgb(h, s, v)))


def order_by_hue(colors):
    """
    Orders colors by hue.
    """
    hsvs = [rgb_to_hsv(*map(down_scale, color)) for color in colors]
    hsvs.sort(key=lambda t: t[0])
    return [tuple(map(up_scale, hsv_to_rgb(*hsv))) for hsv in hsvs]


def brighten(color, brightness):
    """
    Adds or subtracts value to a color.
    """
    h, s, v = rgb_to_hsv(*map(down_scale, color))
    return tuple(map(up_scale, hsv_to_rgb(h, s, v + down_scale(brightness))))


def colorz(fd, n=DEFAULT_NUM_COLORS,min_v=DEFAULT_MINV, max_v=DEFAULT_MAXV,
           bold_add=DEFAULT_BOLD_ADD, order_colors=True):
    

    img = Image.open(fd)
    img.thumbnail(THUMB_SIZE)

    obs = get_colors(img)
    try:
        clamped = [clamp(color, min_v, max_v) for color in obs]
        clusters_ini, float_error_ini = kmeans(array(clamped).astype(float),2)
        total_ini = sum(pdist(clusters_ini))+float_error_ini
        for i in range(3,7):
            clusters, float_error = kmeans(array(clamped).astype(float), i)
            if float_error+sum(pdist(clusters))/comb(i,2) < total_ini:
                clusters_ini, float_error_ini = clusters, float_error
                total_ini = float_error+sum(pdist(clusters))/comb(i,2)
    except Exception:
        return obs[0]
    colors = order_by_hue(clusters_ini) if order_colors else clusters_ini
    return colors[0]
    


def parse_args():
    parser = ArgumentParser(description=__doc__)

    parser.add_argument('image',type=str)

    parser.add_argument('-n',
                        help="""
                        number of colors to generate (excluding bold).
                        Default: %s
                        """ % DEFAULT_NUM_COLORS,
                        dest='num_colors',
                        type=int,
                        default=DEFAULT_NUM_COLORS)

    parser.add_argument('--minv',
                        help="""
                        minimum value for the colors.
                        Default: %s
                        """ % DEFAULT_MINV,
                        type=int,
                        default=DEFAULT_MINV)

    parser.add_argument('--maxv',
                        help="""
                        maximum value for the colors.
                        Default: %s
                        """ % DEFAULT_MAXV,
                        type=int,
                        default=DEFAULT_MAXV)

    parser.add_argument('--bold',
                        help="""
                        how much value to add for bold colors.
                        Default: %s
                        """ % DEFAULT_BOLD_ADD,
                        type=int,
                        default=DEFAULT_BOLD_ADD)

    parser.add_argument('--font-size',
                        help="""
                        what font size to use, in rem.
                        Default: %s
                        """ % DEFAULT_FONT_SIZE,
                        type=int,
                        default=DEFAULT_FONT_SIZE)

    parser.add_argument('--bg-color',
                        help="""
                        what background color to use, in hex format.
                        Default: %s
                        """ % DEFAULT_BG_COLOR,
                        type=str,
                        default=DEFAULT_BG_COLOR)

    parser.add_argument('--no-bg-img',
                        help="""
                        whether or not to use a background image in the
                        preview.
                        Default: background image on
                        """,
                        action='store_true',
                        default=False)

    parser.add_argument('--no-preview',
                        help="""
                        whether or not to generate and show the preview.
                        Default: preview on
                        """,
                        action='store_true',
                        default=False)

    return parser.parse_args()


def main():
    color_pair = []
    args = parse_args()

    img_fd = open(args.image, 'rb') if os.path.isfile(args.image) else \
    BytesIO(urlopen(args.image).read())
    

    color = colorz(img_fd, args.num_colors, args.minv, args.maxv, args.bold)
    print(color)
    #将color传递给php
    

if __name__ == '__main__':

    main()
