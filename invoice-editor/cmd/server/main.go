package main

import (
    "log"
    "net/http"
    "invoice-editor/internal/api"
)

func main() {
    router := api.NewRouter()
    
    loggingRouter := http.HandlerFunc(func(w http.ResponseWriter, r *http.Request) {
        log.Printf("%s %s %s", r.RemoteAddr, r.Method, r.URL)
        router.ServeHTTP(w, r)
    })
    
    log.Println("Starting server on :8080")
    if err := http.ListenAndServe(":8080", loggingRouter); err != nil {
        log.Fatal(err)
    }
}