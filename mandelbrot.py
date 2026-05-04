import turtle
import colorsys


def mandelbrot(c, max_iter):
    z = 0
    for n in range(max_iter):
        z = z * z + c
        if abs(z) > 2:
            return n
    return max_iter


def draw_mandelbrot(pixel_size=2, max_iter=100):
    screen = turtle.Screen()
    screen.title("Mandelbrot Set")
    screen.setup(width=1.0, height=1.0)
    screen.bgcolor("black")
    screen.tracer(0, 0)

    width = screen.window_width()
    height = screen.window_height()

    x_min, x_max = -2.2, 1.0
    y_min, y_max = -1.5, 1.5

    drawer = turtle.Turtle()
    drawer.hideturtle()
    drawer.penup()
    drawer.speed(0)

    for py in range(-height // 2, height // 2, pixel_size):
        for px in range(-width // 2, width // 2, pixel_size):
            x = x_min + (px + width / 2) * (x_max - x_min) / width
            y = y_min + (py + height / 2) * (y_max - y_min) / height
            c = complex(x, y)
            m = mandelbrot(c, max_iter)

            if m == max_iter:
                color = (0, 0, 0)
            else:
                hue = m / max_iter
                color = colorsys.hsv_to_rgb(hue, 1.0, 1.0)

            drawer.goto(px, py)
            drawer.dot(pixel_size, color)

        if py % (pixel_size * 8) == 0:
            screen.update()

    screen.update()
    screen.mainloop()


if __name__ == "__main__":
    draw_mandelbrot(pixel_size=2, max_iter=120)
