package main

import (
	"context"
	"invoice-editor/internal/storage"
	"log"
	"os"
	"path/filepath"
)

func main() {
	// Create temporary test file
	testFile := filepath.Join(os.TempDir(), "test.txt")
	content := []byte("Hello MinIO!")
	if err := os.WriteFile(testFile, content, 0644); err != nil {
		log.Fatalln(err)
	}
	defer os.Remove(testFile)

	// Initialize MinIO service
	minioService, err := storage.NewMinioService()
	if err != nil {
		log.Fatalln(err)
	}

	// Upload file
	ctx := context.Background()
	err = minioService.UploadFile(ctx, "test.txt", testFile, "text/plain")
	if err != nil {
		log.Fatalln(err)
	}
}
