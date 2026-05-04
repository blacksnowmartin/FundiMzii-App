#!/usr/bin/env python3
"""Generate a Mandelbrot set image as an esoteric knowledge shape."""

import sys


def mandelbrot(c, max_iter):
    z = 0 + 0j
    for n in range(max_iter):
        z = z * z + c
        if abs(z) > 2:
            return n
    return max_iter


def make_color(iteration, max_iter):
    if iteration == max_iter:
        return (0, 0, 0)
    t = iteration / max_iter
    r = int(9 * (1 - t) * t * t * t * 255)
    g = int(15 * (1 - t) * (1 - t) * t * t * 255)
    b = int(8.5 * (1 - t) * (1 - t) * (1 - t) * t * 255)
    return (r, g, b)


def render_mandelbrot(width, height, max_iter, x_min, x_max, y_min, y_max, path):
    with open(path, "wb") as f:
        f.write(f"P6 {width} {height} 255\n".encode("ascii"))
        for py in range(height):
            y = y_max - (py / (height - 1)) * (y_max - y_min)
            row = bytearray()
            for px in range(width):
                x = x_min + (px / (width - 1)) * (x_max - x_min)
                c = complex(x, y)
                iteration = mandelbrot(c, max_iter)
                row.extend(make_color(iteration, max_iter))
            f.write(row)


def main():
    width = 1200
    height = 900
    max_iter = 256
    x_min, x_max = -2.2, 1.0
    y_min, y_max = -1.2, 1.2
    output = "mandelbrot.ppm"

    if len(sys.argv) > 1:
        output = sys.argv[1]
    if len(sys.argv) > 3:
        width = int(sys.argv[2])
        height = int(sys.argv[3])
    if len(sys.argv) > 5:
        max_iter = int(sys.argv[4])
        output = sys.argv[5]

    print(f"Rendering Mandelbrot set to {output} ({width}x{height}, max_iter={max_iter})")
    render_mandelbrot(width, height, max_iter, x_min, x_max, y_min, y_max, output)
    print("Done. Open the image with an image viewer that supports PPM.")


if __name__ == "__main__":
    main()
