package pdf

import (
	"fmt"

	"github.com/johnfercher/maroto/pkg/color"
	"github.com/johnfercher/maroto/pkg/consts"
	"github.com/johnfercher/maroto/pkg/pdf"
	"github.com/johnfercher/maroto/pkg/props"
)

func GeneratePDF(outputPath string) error {
	m := pdf.NewMaroto(consts.Portrait, consts.A4)
	m.SetPageMargins(20, 10, 20)

	buildHeading(m)
	buildPDFList(m)

	err := m.OutputFileAndClose(outputPath)
	if err != nil {
		return fmt.Errorf("could not save PDF: %w", err)
	}
	return nil
}

func buildPDFList(m pdf.Maroto) {

	tableHeadings := []string{"Fruit", "Description", "Price"}

	contents := [][]string{{"Apple", "Red and juicy", "2.00"}, {"Orange", "Orange and juicy", "3.00"}}

	lightPurpleColor := getLightPurpleColor()

	m.SetBackgroundColor(getTealColor())
	m.Row(10, func() {
		m.Col(12, func() {
			m.Text("Products", props.Text{
				Top:    2,
				Size:   13,
				Color:  color.NewWhite(),
				Family: consts.Courier,
				Style:  consts.Bold,
				Align:  consts.Center,
			})
		})
	})

	m.SetBackgroundColor(color.NewWhite())

	m.TableList(tableHeadings, contents, props.TableList{

		HeaderProp: props.TableListContent{

			Size: 9,

			GridSizes: []uint{3, 7, 2},
		},

		ContentProp: props.TableListContent{

			Size: 8,

			GridSizes: []uint{3, 7, 2},
		},

		Align: consts.Left,

		AlternatedBackground: &lightPurpleColor,

		HeaderContentSpace: 1,

		Line: false,
	})

}

func getTealColor() color.Color {
	return color.Color{
		Red:   3,
		Green: 166,
		Blue:  166,
	}
}

func getLightPurpleColor() color.Color {
	return color.Color{
		Red:   210,
		Green: 200,
		Blue:  230,
	}
}

func buildHeading(m pdf.Maroto) {
	m.Row(10, func() {
		m.Col(12, func() {
			m.Text("Prepared for you by the Div Rhino Fruit Company", props.Text{
				Top:   3,
				Style: consts.Bold,
				Align: consts.Center,
				Color: getDarkPurpleColor(),
			})
		})
	})
}

func getDarkPurpleColor() color.Color {
	return color.Color{
		Red:   88,
		Green: 80,
		Blue:  99,
	}
}
