package main

import (
	"fmt"
	"invoice-editor/internal/pdf"
	"os"
	"path/filepath"
)

func main() {
	outputPath := filepath.Join("output", "generated.pdf")
	
	// Créer le dossier output s'il n'existe pas
	if err := os.MkdirAll("output", 0755); err != nil {
		fmt.Printf("Erreur lors de la création du dossier: %v\n", err)
		os.Exit(1)
	}

	if err := pdf.GeneratePDF(outputPath); err != nil {
		fmt.Printf("Erreur lors de la génération du PDF: %v\n", err)
		os.Exit(1)
	}

	fmt.Println("PDF généré avec succès:", outputPath)
}
