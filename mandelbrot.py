import turtle
import colorsys
import concurrent.futures


def mandelbrot(c, max_iter):
    z = 0
    for n in range(max_iter):
        z = z * z + c
        if abs(z) > 2:
            return n
    return max_iter


def compute_row(py, pixel_size, width, height, x_min, x_max, y_min, y_max, max_iter):
    row_data = []
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

        row_data.append((px, py, color))
    return row_data


def draw_mandelbrot(pixel_size=4, max_iter=80):
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

    with concurrent.futures.ProcessPoolExecutor() as executor:
        futures = {executor.submit(compute_row, py, pixel_size, width, height, x_min, x_max, y_min, y_max, max_iter): py for py in range(-height // 2, height // 2, pixel_size)}
        
        for future in concurrent.futures.as_completed(futures):
            row_data = future.result()
            for px, py, color in row_data:
                drawer.goto(px, py)
                drawer.dot(pixel_size, color)
            screen.update()

    screen.mainloop()


if __name__ == "__main__":
    draw_mandelbrot(pixel_size=4, max_iter=80)
