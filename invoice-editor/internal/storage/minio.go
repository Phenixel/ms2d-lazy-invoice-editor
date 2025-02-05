package storage

import (
	"context"
	"log"

	"github.com/minio/minio-go/v7"
	"github.com/minio/minio-go/v7/pkg/credentials"
)

type MinioService struct {
	Client     *minio.Client
	BucketName string
}

func NewMinioService() (*MinioService, error) {
	ctx := context.Background()
	endpoint := "localhost:9000"
	accessKeyID := "minioadmin"
	secretAccessKey := "minioadmin"
	useSSL := false

	client, err := minio.New(endpoint, &minio.Options{
		Creds:  credentials.NewStaticV4(accessKeyID, secretAccessKey, ""),
		Secure: useSSL,
	})
	if err != nil {
		return nil, err
	}

	ms := &MinioService{
		Client:     client,
		BucketName: "invoices",
	}

	// Create bucket if it doesn't exist
	err = ms.initBucket(ctx)
	if err != nil {
		return nil, err
	}

	return ms, nil
}

func (ms *MinioService) initBucket(ctx context.Context) error {
	exists, err := ms.Client.BucketExists(ctx, ms.BucketName)
	if err != nil {
		return err
	}

	if !exists {
		err = ms.Client.MakeBucket(ctx, ms.BucketName, minio.MakeBucketOptions{Region: "us-east-1"})
		if err != nil {
			return err
		}
		log.Printf("Created bucket: %s\n", ms.BucketName)
	}

	return nil
}

func (ms *MinioService) UploadFile(ctx context.Context, objectName string, filePath string, contentType string) error {
	info, err := ms.Client.FPutObject(ctx,
		ms.BucketName,
		objectName,
		filePath,
		minio.PutObjectOptions{ContentType: contentType})
	if err != nil {
		return err
	}
	log.Printf("Successfully uploaded %s of size %d\n", objectName, info.Size)
	return nil
}
